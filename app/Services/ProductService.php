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
        $locale = app()->getLocale();

        return $products->flatMap(function ($product) use ($locale) {
                return $product->features->map(function ($feature) use ($locale) {
                    return [
                        'key' => $feature->key,
                        'name' => $feature->getTranslation('name', $locale),
                        'description' => $feature->getTranslation('description', $locale),
                    ];
                });
            })
            ->filter(fn ($feature) => !empty($feature['key']))
            ->unique('key')
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

