<?php



namespace App\Services\GymPlatform;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

class GymRegistrationClient
{
    public function start(array $payload): array
    {
        return $this->parse($this->client()->post('/api/v1/gym-registrations', $payload));
    }

    public function show(string $token): array
    {
        return $this->parse($this->client()->get('/api/v1/gym-registrations/' . $token));
    }

    public function saveDraft(string $token, array $payload): array
    {
        return $this->parse($this->client()->post(
            '/api/v1/gym-registrations/' . $token . '/save-draft',
            $payload
        ));
    }

    public function submitStep(string $token, array $payload): array
    {
        return $this->parse($this->client()->post(
            '/api/v1/gym-registrations/' . $token . '/submit-step',
            $payload
        ));
    }

    public function uploadMedia(string $token, UploadedFile $file, string $type): array
    {
        // Multipart upload must not use asJson() — that drops file/type fields.
        $path = $file->getRealPath();
        if ($path === false || ! is_readable($path)) {
            throw new RuntimeException('Unable to read uploaded file.');
        }

        $response = $this->multipartClient()
            ->attach(
                'file',
                file_get_contents($path),
                $file->getClientOriginalName() ?: 'upload.bin',
                ['Content-Type' => $file->getMimeType() ?: 'application/octet-stream']
            )
            ->post('/api/v1/gym-registrations/' . $token . '/upload', [
                'type' => $type,
            ]);

        $parsed = $this->parse($response);
        $parsed['url'] = $response->json('url');
        $parsed['type'] = $response->json('type') ?? $type;

        return $parsed;
    }

    public function submit(string $token, array $payload = []): array
    {
        return $this->parse($this->client()->post(
            '/api/v1/gym-registrations/' . $token . '/submit',
            $payload
        ));
    }

    protected function client(): PendingRequest
    {
        return $this->baseClient()->asJson();
    }

    protected function multipartClient(): PendingRequest
    {
        return $this->baseClient();
    }

    protected function baseClient(): PendingRequest
    {
        $baseUrl = rtrim((string) config('services.gym_platform.url'), '/');
        $apiKey = (string) config('services.gym_platform.api_key');
        $timeout = (int) config('services.gym_platform.timeout', 30);

        if ($baseUrl === '' || $apiKey === '') {
            throw new RuntimeException('Gym platform integration is not configured.');
        }

        return Http::baseUrl($baseUrl)
            ->timeout($timeout)
            ->acceptJson()
            ->withHeaders([
                'X-Api-Key' => $apiKey,
            ]);
    }

    protected function parse(Response $response): array
    {
        $json = $response->json() ?? [];

        if ($response->failed()) {
            Log::warning('Gym platform registration API error', [
                'status' => $response->status(),
                'message' => $json['message'] ?? null,
            ]);
        }

        return [
            'ok' => $response->successful() && ($json['success'] ?? false),
            'status' => $response->status(),
            'message' => $json['message'] ?? ($response->successful() ? 'OK' : 'Request failed.'),
            'errors' => $json['errors'] ?? [],
            'data' => $json['data'] ?? null,
            'raw' => $json,
        ];
    }
}
