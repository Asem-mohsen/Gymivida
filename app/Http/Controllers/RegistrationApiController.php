<?php

namespace App\Http\Controllers;

use App\Http\Requests\Registration\{SaveDraftRequest, SubmitStepRequest, UploadMediaRequest, FinalSubmitRequest};
use App\Services\GymRegistrationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use RuntimeException;

class RegistrationApiController extends Controller
{
    public function __construct(
        protected GymRegistrationService $registrationService,
    ) {}

    public function start(Request $request): JsonResponse
    {
        try {
            $result = $this->registrationService->ensureDraft([
                'locale' => app()->getLocale(),
                'external_plan_id' => $request->input('external_plan_id'),
                'plan_name' => $request->input('plan_name'),
                'billing_cycle' => $request->input('billing_cycle', 'monthly'),
            ]);

            return response()->json([
                'success' => true,
                'message' => $result['message'] ?? 'Draft ready.',
                'data' => $result['data'],
            ]);
        } catch (RuntimeException $e) {
            return $this->failure($e->getMessage(), 502);
        }
    }

    public function show(): JsonResponse
    {
        $current = $this->registrationService->showCurrent();

        if (! $current) {
            return $this->failure(__('registration.no_active_draft'), 404);
        }

        return response()->json([
            'success' => true,
            'data' => $current['data'],
        ]);
    }

    public function saveDraft(SaveDraftRequest $request): JsonResponse
    {
        return $this->proxy(fn () => $this->registrationService->saveDraft(
            $this->sanitizePayload($request->validated())
        ));
    }

    public function submitStep(SubmitStepRequest $request): JsonResponse
    {
        return $this->proxy(fn () => $this->registrationService->submitStep(
            $this->sanitizePayload($request->validated())
        ));
    }

    public function upload(UploadMediaRequest $request): JsonResponse
    {
        return $this->proxy(fn () => $this->registrationService->uploadMedia(
            $request->file('file'),
            $request->validated('type')
        ));
    }

    public function submit(FinalSubmitRequest $request): JsonResponse
    {
        return $this->proxy(fn () => $this->registrationService->submit(
            $this->sanitizePayload($request->validated())
        ), successRedirect: true);
    }

    protected function proxy(callable $callback, bool $successRedirect = false): JsonResponse
    {
        try {
            $result = $callback();

            if (! $result['ok']) {
                return response()->json([
                    'success' => false,
                    'message' => $result['message'],
                    'errors' => $result['errors'],
                    'data' => $result['data'],
                ], $result['status'] >= 400 ? $result['status'] : 422);
            }

            $payload = [
                'success' => true,
                'message' => $result['message'],
                'data' => $result['data'],
            ];

            if (! empty($result['url'])) {
                $payload['url'] = $result['url'];
            }
            if (! empty($result['type'])) {
                $payload['type'] = $result['type'];
            }

            if ($successRedirect) {
                $payload['redirect'] = route('registration.success', ['locale' => app()->getLocale()]);
            }

            return response()->json($payload);
        } catch (RuntimeException $e) {
            return $this->failure($e->getMessage(), 502);
        }
    }

    /**
     * @param  array<string, mixed>  $payload
     * @return array<string, mixed>
     */
    protected function sanitizePayload(array $payload): array
    {
        unset(
            $payload['password'],
            $payload['password_confirmation'],
            $payload['confirm'],
        );

        return $payload;
    }

    protected function failure(string $message, int $status): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'errors' => [],
        ], $status);
    }
}
