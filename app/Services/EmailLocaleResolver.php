<?php



namespace App\Services;

use App\Enums\AppLocale;
use Illuminate\Http\Request;

/**
 * Resolves the locale for outbound emails so language stays correct for
 * sync sends, queued mail, notifications, and scheduled jobs.
 *
 * Priority: explicit → initiating request → notifiable preference → app locale → English.
 * An Arabic site action must win over a saved English preference for that operation.
 */
class EmailLocaleResolver
{
    public function resolve(
        AppLocale|string|null $explicit = null,
        ?object $notifiable = null,
        ?Request $request = null,
    ): AppLocale {
        if ($this->hasExplicitLocale($explicit)) {
            return AppLocale::normalize($explicit);
        }

        $fromRequest = $this->fromRequest($request ?? (app()->bound('request') ? request() : null));
        if ($fromRequest !== null) {
            return $fromRequest;
        }

        $fromNotifiable = $this->fromNotifiable($notifiable);
        if ($fromNotifiable !== null) {
            return $fromNotifiable;
        }

        if (AppLocale::isSupported(app()->getLocale())) {
            return AppLocale::normalize(app()->getLocale());
        }

        return AppLocale::En;
    }

    /**
     * Capture locale from a website-triggered HTTP request (/en|/ar, body, query, referer).
     */
    public function resolveFromRequest(?Request $request = null): AppLocale
    {
        return $this->resolve(explicit: null, notifiable: null, request: $request);
    }

    private function hasExplicitLocale(AppLocale|string|null $explicit): bool
    {
        if ($explicit instanceof AppLocale) {
            return true;
        }

        return is_string($explicit) && $explicit !== '';
    }

    private function fromNotifiable(?object $notifiable): ?AppLocale
    {
        if ($notifiable === null) {
            return null;
        }

        if (method_exists($notifiable, 'preferredLocale')) {
            $preferred = $notifiable->preferredLocale();
            if (is_string($preferred) && $preferred !== '') {
                return AppLocale::normalize($preferred);
            }
        }

        foreach (['preferred_locale', 'locale', 'language'] as $attribute) {
            if (! isset($notifiable->{$attribute})) {
                continue;
            }

            $value = $notifiable->{$attribute};

            if ($value instanceof AppLocale) {
                return $value;
            }

            if (is_string($value) && $value !== '') {
                return AppLocale::normalize($value);
            }
        }

        return null;
    }

    private function fromRequest(?Request $request): ?AppLocale
    {
        if ($request === null) {
            return null;
        }

        $candidates = [
            $request->input('locale'),
            $request->query('locale'),
            $request->route('locale'),
            $request->segment(1),
        ];

        foreach ($candidates as $candidate) {
            if (is_string($candidate) && AppLocale::isSupported($candidate)) {
                return AppLocale::from($candidate);
            }
        }

        $referer = $request->headers->get('referer');
        if (is_string($referer) && preg_match('#/(en|ar)(?:/|$|\?)#', $referer, $matches) === 1) {
            return AppLocale::from($matches[1]);
        }

        return null;
    }
}
