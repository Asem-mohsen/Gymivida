<?php



namespace App\Mail;

use App\Enums\AppLocale;
use App\Models\ContactUs;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CompleteRegistrationMail extends LocalizedMailable
{
    use SerializesModels;

    public function __construct(
        public ContactUs $contact,
        public string $registrationUrl,
        AppLocale|string|null $locale = null,
    ) {
        $this->localize($locale, $contact);
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: __('mail.complete_registration.subject'),
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
