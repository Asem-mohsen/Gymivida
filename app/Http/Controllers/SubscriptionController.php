<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SubscriptionController extends Controller
{
    public function upgrade(Request $request)
    {
        $validated = $request->validate([
            'token' => ['required', 'string'],
            'selected_plan_id' => ['required', 'integer'],
        ]);

        $baseUrl = rtrim((string) config('app.gymivida_website'), '/');

        try {
            $response = Http::acceptJson()
                ->asJson()
                ->post("{$baseUrl}/api/v1/subscription/upgrade", [
                    'token' => $validated['token'],
                    'selected_plan_id' => $validated['selected_plan_id'],
                ]);

            return response()->json(
                $response->json() ?? [],
                $response->status()
            );
        } catch (\Throwable) {
            return response()->json([
                'message' => 'Unable to process upgrade right now.',
            ], 500);
        }
    }
}
