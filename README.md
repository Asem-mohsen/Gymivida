# Gymivida

Gym discovery, booking, and gym-management marketing site for Gymivida (`gymivida.pyraven.com`), built with Laravel 11.

Public site languages: **English** (`/en`) and **Arabic** (`/ar`). English is the application and email fallback.

## Feature map

| Feature | Purpose | Location |
| --- | --- | --- |
| Locale routing & middleware | Serve `/en` and `/ar`, set app locale from URL | `routes/web.php`, `app/Http/Middleware/LocaleMiddleware.php`, `app/Support/Localization.php` |
| Email localization | EN/AR transactional mail that survives queues and admin resends | `app/Services/EmailLocaleResolver.php`, `app/Mail/LocalizedMailable.php`, `lang/{en,ar}/mail.php`, `docs/email-localization.md` |
| Contact form | Capture inquiries; notify admin; store initiating locale | `app/Services/ContactUsService.php`, `app/Mail/*`, `resources/views/emails/*` |
| Gym registration | Multi-step owner registration against the gym platform API | `app/Services/GymRegistrationService.php`, `app/Http/Controllers/Registration*` |
| Documentation downloads | Locale-aware PDF demos | `app/Services/DocumentationService.php`, `AppLocale` on `documentations` |
| Filament admin | Manage contacts, FAQs, products, docs, sitemap | `app/Filament/` |
| Sitemap | Generate locale-prefixed URLs | `app/Console/Commands/GenerateSitemap.php` |

## Email language rules (summary)

- Action on `/ar` → Arabic user-facing email; action on `/en` → English.  
- Missing/invalid locale → English.  
- Contact locale is stored on `contact_us` so later registration emails stay correct.  
- Details: [docs/email-localization.md](docs/email-localization.md).

## Stack

Laravel 11, Blade, Filament, MySQL, Laravel localization (`lang/en`, `lang/ar`).
