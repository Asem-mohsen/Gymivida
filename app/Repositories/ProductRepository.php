<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository
{
    public function getAllActiveWithFeatures(): Collection
    {
        return Product::with('features')
            ->where('is_active', true)
            ->orderBy('monthly_price')
            ->get();
    }
}

