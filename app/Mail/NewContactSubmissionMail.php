<?php

namespace App\Mail;

use App\Models\ContactUs;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewContactSubmissionMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public ContactUs $contact)
    {
        //
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Contact Form Submission - Gymivida',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.new-contact-submission',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
