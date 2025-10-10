<?php

namespace App\Services;

use App\Models\ContactUs;
use App\Repositories\ContactUsRepository;

class ContactUsService
{
    public function __construct(
        protected ContactUsRepository $contactUsRepository
    ) {}


    public function store(array $data): ContactUs
    {
        $data['status'] = ContactUs::STATUS_NEW;

        $data['name'] = strip_tags($data['name']);
        $data['email'] = filter_var($data['email'], FILTER_SANITIZE_EMAIL);
        $data['phone'] = isset($data['phone']) ? strip_tags($data['phone']) : null;
        $data['subject'] = isset($data['subject']) ? strip_tags($data['subject']) : null;
        $data['message'] = strip_tags($data['message']);

        $contact = $this->contactUsRepository->create($data);

        return $contact;
    }
}

