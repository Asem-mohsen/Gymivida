<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactUsRequest;
use App\Services\ContactUsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class ContactUsController extends Controller
{
    public function __construct(
        protected ContactUsService $contactUsService
    ) {}


    public function store(StoreContactUsRequest $request): JsonResponse
    {
        try {
            $contact = $this->contactUsService->store($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Your message has been sent successfully. We\'ll be in touch soon!',
                'data' => [
                    'id' => $contact->id,
                ]
            ], 201);

        } catch (\Exception $e) {
            Log::error('Contact form submission failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Sorry, there was an error processing your request. Please try again later.',
                'errors' => []
            ], 500);
        }
    }

    public function verifyToken(): JsonResponse
    {
        $token = request('token');
        $email = request('email');

        if (!$token) {
            return response()->json([
                'success' => false,
                'valid' => false,
                'message' => 'Token is required.',
                'data' => null
            ], 400);
        }

        try {
            $result = $this->contactUsService->verifyRegistrationToken($token, $email);

            return response()->json([
                'success' => $result['valid'],
                'valid' => $result['valid'],
                'message' => $result['message'],
                'data' => $result['data']
            ], $result['valid'] ? 200 : 404);

        } catch (\Exception $e) {
            Log::error('Token verification failed', [
                'token' => $token,
                'email' => $email,
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'valid' => false,
                'message' => 'An error occurred while verifying the token.',
                'data' => null
            ], 500);
        }
    }
}

