<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Product;
use App\Services\GymPlatform\GymRegistrationClient;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use RuntimeException;

class GymRegistrationService
{
    private const SESSION_TOKEN_KEY = 'gym_registration.token';
    private const SESSION_IDEMPOTENCY_KEY = 'gym_registration.idempotency_key';

    public function __construct(
        protected GymRegistrationClient $client,
        protected ProductService $productService,
    ) {}

    public function resolvePlanFromQuery(?string $planSlug, ?string $billing): array
    {
        $billingCycle = in_array($billing, ['monthly', 'yearly'], true) ? $billing : 'monthly';
        $products = $this->productService->getActiveProductsWithFeatures();

        $selected = null;
        if (filled($planSlug)) {
            $needle = Str::lower(str_replace([' ', '_'], '-', $planSlug));
            $selected = $products->first(function (Product $product) use ($needle, $planSlug) {
                $en = Str::lower(str_replace([' ', '_'], '-', $product->getTranslation('name', 'en')));

                return $en === $needle || (string) $product->id === $planSlug;
            });
        }

        return [
            'products' => $products,
            'selected_plan_id' => $selected?->id,
            'billing_cycle' => $billingCycle,
        ];
    }

    public function ensureDraft(array $attributes = []): array
    {
        $token = Session::get(self::SESSION_TOKEN_KEY);
        if (is_string($token) && $token !== '') {
            $existing = $this->client->show($token);
            if ($existing['ok'] && ($existing['data']['can_edit'] ?? false)) {
                return $existing;
            }
        }

        $idempotencyKey = Session::get(self::SESSION_IDEMPOTENCY_KEY);
        if (! is_string($idempotencyKey) || $idempotencyKey === '') {
            $idempotencyKey = (string) Str::uuid();
            Session::put(self::SESSION_IDEMPOTENCY_KEY, $idempotencyKey);
        }

        $result = $this->client->start(array_filter([
            'idempotency_key' => $idempotencyKey,
            'locale' => $attributes['locale'] ?? app()->getLocale(),
            'external_plan_id' => isset($attributes['external_plan_id']) ? (string) $attributes['external_plan_id'] : null,
            'plan_name' => $attributes['plan_name'] ?? null,
            'billing_cycle' => $attributes['billing_cycle'] ?? 'monthly',
            'source' => 'marketing_site',
        ], fn ($value) => $value !== null && $value !== ''));

        if (! $result['ok'] || empty($result['data']['reference'])) {
            throw new RuntimeException($result['message'] ?? 'Unable to start registration.');
        }

        Session::put(self::SESSION_TOKEN_KEY, $result['data']['reference']);

        return $result;
    }

    public function resume(string $token): array
    {
        $result = $this->client->show($token);

        if (! $result['ok']) {
            throw new RuntimeException($result['message'] ?? 'Registration not found.');
        }

        Session::put(self::SESSION_TOKEN_KEY, $token);

        return $result;
    }

    public function currentToken(): ?string
    {
        $token = Session::get(self::SESSION_TOKEN_KEY);

        return is_string($token) && $token !== '' ? $token : null;
    }

    public function saveDraft(array $payload): array
    {
        return $this->client->saveDraft($this->requireToken(), $payload);
    }

    public function submitStep(array $payload): array
    {
        return $this->client->submitStep($this->requireToken(), $payload);
    }

    public function uploadMedia(UploadedFile $file, string $type): array
    {
        return $this->client->uploadMedia($this->requireToken(), $file, $type);
    }

    public function submit(array $payload = []): array
    {
        $result = $this->client->submit($this->requireToken(), $payload);

        if ($result['ok']) {
            Session::forget([self::SESSION_TOKEN_KEY, self::SESSION_IDEMPOTENCY_KEY]);
        }

        return $result;
    }

    public function showCurrent(): ?array
    {
        $token = $this->currentToken();
        if (! $token) {
            return null;
        }

        $result = $this->client->show($token);

        return $result['ok'] ? $result : null;
    }

    protected function requireToken(): string
    {
        $token = $this->currentToken();
        if (! $token) {
            throw new RuntimeException('No active registration draft.');
        }

        return $token;
    }
}
