<?php

namespace App\Http\Controllers;

use App\Services\FeatureService;
use Illuminate\Http\JsonResponse;

class FeatureController extends Controller
{
    public function __construct(
        protected FeatureService $featureService
    ) {}

    public function getActiveFeatures(): JsonResponse
    {
        try {
            $features = $this->featureService->getActiveFeatures();

            return response()->json([
                'success' => true,
                'data' => $features
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch features.',
                'data' => []
            ], 500);
        }
    }
}
