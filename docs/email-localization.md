# Email localization (EN / AR)

Transactional emails follow the language of the **initiating website action** (`/en` or `/ar`), not a global app locale alone. English is the safe default when locale cannot be determined. Unsupported locales never throw — they fall back to English via `AppLocale::normalize()`.

## Why this approach

Queue workers and Filament actions have no HTTP `/ar` context. Relying only on `app()->getLocale()` would send English from the worker even when the user submitted from Arabic. Locale is therefore **resolved once**, **persisted** on the contact (when relevant), and **pinned on the Mailable** with Laravel’s `$mailable->locale()` / `Mail::locale()` so queued jobs serialize the correct language.

Visiting `/ar` does **not** rewrite a user’s saved preference; it only affects emails for that operation. Admin ops mail (`NewContactSubmissionMail`) stays English unless an explicit locale is passed.

## Resolution order (`EmailLocaleResolver`)

1. Explicit locale passed into the send path  
2. Initiating request (`locale` input/query/route/segment, then Referer `/en|/ar`)  
3. Notifiable preference (`preferredLocale()`, `locale`, etc.)  
4. Current app locale if supported  
5. English  

Website-triggered Arabic actions therefore beat a saved English preference for that send. Queued/admin resends rely on the stored contact locale (or an explicit argument), because the worker has no `/ar` request.

## Key pieces

| Piece | Role |
| --- | --- |
| `App\Services\EmailLocaleResolver` | Central resolution |
| `App\Mail\LocalizedMailable` | Pins locale on every mailable |
| `lang/{en,ar}/mail.php` | All user-facing email copy |
| `contact_us.locale` | Survives admin “Send Registration Email” later |

## Adding a new email

1. Extend `LocalizedMailable` and call `$this->localize($explicit, $notifiable)` in the constructor.  
2. Put subjects/body strings in `lang/en/mail.php` and `lang/ar/mail.php`.  
3. Use `__('mail...')` in the Blade view (locale is set before render).  
4. Prefer `Mail::locale($resolved)->send(...)` when sending from services so the facade and mailable agree.  
5. For website-triggered API calls outside `{locale}` routes, pass `locale` in the request body (contact form already does).

## Limits

- Only `en` and `ar` are supported.  
- Filament password-reset mail uses Laravel/Filament defaults (admin English).  
- Product/feature names inside emails still use the model’s stored name (not separately translated here).
