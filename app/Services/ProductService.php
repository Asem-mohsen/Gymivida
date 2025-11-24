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

    public function getComparisonFeatures(Collection $products): array
    {
        return $products->flatMap(function ($product) {
                return $product->features->map(function ($feature) {
                    return [
                        'name' => $feature->name,
                        'description' => $feature->description,
                    ];
                });
            })
            ->filter(fn ($feature) => !empty($feature['name']))
            ->unique('name')
            ->values()
            ->toArray();
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
                'trial_period_days' => $product->trial_period_days,
                'currency' => $product->currency,
            ];
        })->toArray();
    }

    public function getActiveProductById(int $id)
    {
        return $this->productRepository->getActiveProductById($id);
    }
}

