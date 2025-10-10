<?php

namespace App\Repositories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Collection;

class ServiceRepository
{
    public function getAllActive(): Collection
    {
        return Service::active()->ordered()->get();
    }
}

