<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use Illuminate\Database\Eloquent\Collection;

class ProductService
{
    protected ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getActiveProductsWithFeatures(): Collection
    {
        return $this->productRepository->getAllActiveWithFeatures();
    }

    public function getActiveProducts(): array
    {
        $products = $this->productRepository->getActiveProducts();
        
        return $products->map(function ($product) {
            return [
                'id' => $product->id,
                'name' => $product->name,
                'monthly_price' => $product->monthly_price,
                'yearly_price' => $product->yearly_price,
                'currency' => $product->currency,
            ];
        })->toArray();
    }

    public function getActiveProductById(int $id)
    {
        return $this->productRepository->getActiveProductById($id);
    }
}

