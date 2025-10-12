<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function __construct(
        protected ProductService $productService
    ) {}

    /**
     * Get all active products for the contact form dropdown.
     */
    public function getActiveProducts(): JsonResponse
    {
        try {
            $products = $this->productService->getActiveProducts();

            return response()->json([
                'success' => true,
                'data' => $products
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch products.',
                'data' => []
            ], 500);
        }
    }

    public function getActiveProductById(int $id): JsonResponse
    {
        try {
            $product = $this->productService->getActiveProductById($id);

            return response()->json([
                'success' => true,
                'data' => $product
            ], 200);

        } catch (\Exception $e) {
            Log::error('Failed to fetch product', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch product.',
                'data' => []
            ], 500);
        }
    }
}
