<?php



namespace App\Mail;

use App\Enums\AppLocale;
use App\Models\ContactUs;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewContactSubmissionMail extends LocalizedMailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public ContactUs $contact,
        AppLocale|string|null $locale = null,
    ) {
        // Internal ops email: English by default unless an explicit locale is passed.
        $this->localize($locale ?? AppLocale::En);
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: __('mail.new_contact_submission.subject'),
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
