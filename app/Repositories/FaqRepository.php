<?php

namespace App\Repositories;

use App\Models\Faq;
use Illuminate\Database\Eloquent\Collection;

class FaqRepository
{
    public function getOrdered(): Collection
    {
        return Faq::query()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();
    }
}
