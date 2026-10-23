<?php



namespace App\Support;

use App\Enums\AppLocale;

class Localization
{
    public function getCurrentLocale(): string
    {
        return AppLocale::normalize(app()->getLocale())->value;
    }

    public function getDirection(): string
    {
        return AppLocale::normalize($this->getCurrentLocale())->direction();
    }

    public function isRtl(): bool
    {
        return AppLocale::normalize($this->getCurrentLocale())->isRtl();
    }

    /**
     * @return array<string, string>
     */
    public function getAlternateUrls(string $routeName, array $parameters = []): array
    {
        $urls = [];
        $currentLocale = $this->getCurrentLocale();

        foreach ($this->getSupportedLocales() as $locale) {
            if ($locale !== $currentLocale) {
                $urls[$locale] = $this->getLocalizedUrl($routeName, $parameters, $locale);
            }
        }

        return $urls;
    }

    public function getLocalizedUrl(string $routeName, array $parameters = [], ?string $locale = null): string
    {
        $parameters['locale'] = AppLocale::normalize($locale ?? $this->getCurrentLocale())->value;

        return route($routeName, $parameters);
    }

    public function getCurrentUrlWithLocale(string $locale): string
    {
        $locale = AppLocale::normalize($locale)->value;
        $currentPath = request()->path();
        $currentLocale = $this->getCurrentLocale();

        if (AppLocale::isSupported($currentLocale)) {
            $currentPath = preg_replace('/^'.preg_quote($currentLocale, '/').'\//', '', $currentPath) ?? $currentPath;
            if ($currentPath === $currentLocale) {
                $currentPath = '';
            }
        }

        return url($locale.'/'.ltrim($currentPath, '/'));
    }

    public function isValidLocale(string $locale): bool
    {
        return AppLocale::isSupported($locale);
    }

    /**
     * @return list<string>
     */
    public function getSupportedLocales(): array
    {
        return AppLocale::values();
    }

    public function getLocaleName(string $locale): string
    {
        return match (AppLocale::normalize($locale)) {
            AppLocale::En => 'English',
            AppLocale::Ar => 'العربية',
        };
    }
}
