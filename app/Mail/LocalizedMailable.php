<?php



namespace App\Mail;

use App\Enums\AppLocale;
use App\Services\EmailLocaleResolver;
use Illuminate\Mail\Mailable;

/**
 * Base mailable that pins a resolved locale onto the message.
 * Laravel serializes `$this->locale` for queued mail, so workers render the correct language.
 */
abstract class LocalizedMailable extends Mailable
{
    protected function localize(
        AppLocale|string|null $explicit = null,
        ?object $notifiable = null,
    ): static {
        $locale = app(EmailLocaleResolver::class)->resolve($explicit, $notifiable);
        $this->locale($locale->value);

        return $this;
    }

    public function emailLocale(): AppLocale
    {
        return AppLocale::normalize($this->locale);
    }
}
