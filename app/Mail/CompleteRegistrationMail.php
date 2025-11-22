<?php

namespace App\Mail;

use App\Models\ContactUs;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CompleteRegistrationMail extends Mailable
{
    use SerializesModels;

    public function __construct(public ContactUs $contact,public string $registrationUrl) 
    {

    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Complete Your Gym Registration - Gymivida',
        );
    }


    public function content(): Content
    {
        return new Content(
            view: 'emails.complete-registration',
        );
    }


    public function attachments(): array
    {
        return [];
    }
}
