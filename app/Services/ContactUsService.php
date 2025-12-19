<?php

namespace App\Services;

use App\Mail\CompleteRegistrationMail;
use App\Mail\NewContactSubmissionMail;
use App\Models\ContactUs;
use App\Repositories\ContactUsRepository;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

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
        
        $data['wants_registration_email'] = isset($data['wants_registration_email']) && $data['wants_registration_email'];

        $contact = $this->contactUsRepository->create($data);

        if ($contact->wants_registration_email) {
            $this->sendRegistrationEmail($contact);
        }

        $this->sendAdminNotificationEmail($contact);

        return $contact;
    }

    public function sendAdminNotificationEmail(ContactUs $contact): bool
    {
        $adminEmail = env('ADMIN_EMAIL', 'asemmohsen911@gmail.com');

        try {
            Mail::to($adminEmail)->send(new NewContactSubmissionMail($contact));
            
            return true;
        } catch (\Exception $e) {
            Log::error('Failed to send admin notification email', [
                'contact_id' => $contact->id,
                'admin_email' => $adminEmail,
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }

    public function sendRegistrationEmail(ContactUs $contact): bool
    {
        if (!$contact->registration_token) {
            $contact->registration_token = Str::random(64);
            $contact->save();
        }

        $externalUrl = config('app.registration_form_endpoint');
        $registrationUrl = $externalUrl . '?token=' . $contact->registration_token . '&email=' . urlencode($contact->email);

        try {
            Mail::to($contact->email)->send(new CompleteRegistrationMail($contact, $registrationUrl));
            
            $contact->registration_email_sent_at = now();
            $contact->save();
            
            return true;
        } catch (\Exception $e) {
            Log::error('Failed to send registration email', [
                'contact_id' => $contact->id,
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }

    public function verifyRegistrationToken(string $token, ?string $email = null): array
    {
        $contact = $email 
            ? $this->contactUsRepository->findByTokenAndEmail($token, $email)
            : $this->contactUsRepository->findByToken($token);

        if (!$contact) {
            return [
                'valid' => false,
                'message' => 'Invalid or expired registration token.',
                'data' => null
            ];
        }

        if (!$contact->registration_token) {
            return [
                'valid' => false,
                'message' => 'This contact does not have a valid registration token.',
                'data' => null
            ];
        }

        return [
            'valid' => true,
            'message' => 'Token is valid.',
            'data' => [
                'id' => $contact->id,
                'name' => $contact->name,
                'email' => $contact->email,
                'phone' => $contact->phone,
                'product_id' => $contact->product_id,
                'product_name' => $contact->product ? $contact->product->name : null,
                'registered_at' => $contact->registration_email_sent_at?->toDateTimeString(),
            ]
        ];
    }
}

