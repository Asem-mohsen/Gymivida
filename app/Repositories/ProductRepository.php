<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository
{
    public function getAllActiveWithFeatures(): Collection
    {
        return Product::select([
                'id',
                'name',
                'description',
                'monthly_price',
                'yearly_price',
                'trial_period_days',
                'currency',
            ])
            ->with(['features:id,name,description'])
            ->where('is_active', true)
            ->orderBy('monthly_price')
            ->get();
    }

    public function getActiveProducts(): Collection
    {
        return Product::select(['id', 'name', 'monthly_price', 'yearly_price', 'trial_period_days', 'currency'])
            ->where('is_active', true)
            ->orderBy('name')
            ->get();
    }

    public function getActiveProductById(int $id): Product
    {
        return Product::whereId($id)->with('features')->select(['id', 'name', 'monthly_price', 'yearly_price', 'trial_period_days', 'description', 'currency'])
            ->where('is_active', true)
            ->first();
    }
}

