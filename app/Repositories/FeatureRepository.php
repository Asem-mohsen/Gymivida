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
}

