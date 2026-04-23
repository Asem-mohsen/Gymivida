<?php

namespace App\Services;

use App\Repositories\FaqRepository;
use Illuminate\Database\Eloquent\Collection;

class FaqService
{
    public function __construct(
        protected FaqRepository $faqRepository
    ) {}

    public function getOrdered(): Collection
    {
        return $this->faqRepository->getOrdered();
    }
}
