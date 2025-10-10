<?php

namespace App\Services;

use App\Repositories\ServiceRepository;
use Illuminate\Database\Eloquent\Collection;

class ServiceService
{
    public function __construct(protected ServiceRepository $serviceRepository)
    {
        $this->serviceRepository = $serviceRepository;
    }

    public function getActiveServices(): Collection
    {
        return $this->serviceRepository->getAllActive();
    }
}

