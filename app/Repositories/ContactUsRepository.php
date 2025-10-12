<?php

namespace App\Repositories;

use App\Models\ContactUs;

class ContactUsRepository
{
    public function create(array $data): ContactUs
    {
        return ContactUs::create($data);
    }

    public function findByToken(string $token): ?ContactUs
    {
        return ContactUs::with('product')
            ->where('registration_token', $token)
            ->first();
    }

    public function findByTokenAndEmail(string $token, string $email): ?ContactUs
    {
        return ContactUs::with('product')
            ->where('registration_token', $token)
            ->where('email', $email)
            ->first();
    }
}

