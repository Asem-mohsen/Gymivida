<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum AppLocale: string implements HasLabel
{
    case En = 'en';
    case Ar = 'ar';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::En => 'English',
            self::Ar => 'Arabic',
        };
    }

    /**
     * @return list<string>
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function normalize(self|string|null $locale): self
    {
        if ($locale instanceof self) {
            return $locale;
        }

        return self::tryFrom((string) $locale) ?? self::En;
    }
}
