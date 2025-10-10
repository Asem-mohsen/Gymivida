<?php

namespace App\Repositories;

use App\Models\ContactUs;

class ContactUsRepository
{
    public function create(array $data): ContactUs
    {
        return ContactUs::create($data);
    }
}

