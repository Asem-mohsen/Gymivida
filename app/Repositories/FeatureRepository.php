<?php

namespace App\Repositories;

use App\Models\Feature;
use Illuminate\Database\Eloquent\Collection;

class FeatureRepository
{
    public function getAllActive(): Collection
    {
        return Feature::where('is_active', true)
            ->where('is_hidden', false)
            ->orderBy('name')
            ->get();
    }

    public function getFeaturesByProductId(int $productId): Collection
    {
        return Feature::select(['id', 'name', 'description', 'key'])
            ->where('is_active', true)
            ->where('is_hidden', false)
            ->whereHas('products', function ($query) use ($productId) {
                $query->where('product_id', $productId);
            })
            ->orderBy('name')
            ->get();
    }   
}

