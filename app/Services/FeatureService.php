<?php

namespace App\Services;

use App\Repositories\FeatureRepository;
use Illuminate\Database\Eloquent\Collection;

class FeatureService
{
    protected FeatureRepository $featureRepository;

    public function __construct(FeatureRepository $featureRepository)
    {
        $this->featureRepository = $featureRepository;
    }

    public function getActiveFeatures(): array
    {
        $features = $this->featureRepository->getAllActive();
        
        return $features->map(function ($feature) {
            return [
                'id' => $feature->id,
                'key' => $feature->key,
                'name' => $feature->name,
                'description' => $feature->description,
            ];
        })->toArray();
    }
}

