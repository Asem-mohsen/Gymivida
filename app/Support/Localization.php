<?php

namespace App\Support;

class Localization
{
    /**
     * Supported locales
     */
    protected array $supportedLocales = ['en', 'ar'];

    /**
     * Get current locale
     */
    public function getCurrentLocale(): string
    {
        return app()->getLocale();
    }

    /**
     * Get direction (rtl or ltr) for current locale
     */
    public function getDirection(): string
    {
        return $this->getCurrentLocale() === 'ar' ? 'rtl' : 'ltr';
    }

    /**
     * Check if current locale is RTL
     */
    public function isRtl(): bool
    {
        return $this->getDirection() === 'rtl';
    }

    /**
     * Get alternate locale URLs for hreflang
     */
    public function getAlternateUrls(string $routeName, array $parameters = []): array
    {
        $urls = [];
        $currentLocale = $this->getCurrentLocale();

        foreach ($this->supportedLocales as $locale) {
            if ($locale !== $currentLocale) {
                $urls[$locale] = $this->getLocalizedUrl($routeName, $parameters, $locale);
            }
        }

        return $urls;
    }

    /**
     * Get localized URL for a route
     */
    public function getLocalizedUrl(string $routeName, array $parameters = [], ?string $locale = null): string
    {
        $locale = $locale ?? $this->getCurrentLocale();
        $parameters['locale'] = $locale;

        return route($routeName, $parameters);
    }

    /**
     * Get current URL with different locale
     */
    public function getCurrentUrlWithLocale(string $locale): string
    {
        $currentPath = request()->path();
        $currentLocale = $this->getCurrentLocale();

        // Remove current locale prefix if exists
        if (in_array($currentLocale, $this->supportedLocales)) {
            $currentPath = preg_replace('/^' . preg_quote($currentLocale, '/') . '\//', '', $currentPath);
        }

        // Add new locale prefix
        return url($locale . '/' . ltrim($currentPath, '/'));
    }

    /**
     * Validate locale
     */
    public function isValidLocale(string $locale): bool
    {
        return in_array($locale, $this->supportedLocales);
    }

    /**
     * Get supported locales
     */
    public function getSupportedLocales(): array
    {
        return $this->supportedLocales;
    }

    /**
     * Get locale name for display
     */
    public function getLocaleName(string $locale): string
    {
        return match ($locale) {
            'en' => 'English',
            'ar' => 'العربية',
            default => $locale,
        };
    }
}
