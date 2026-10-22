<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum DocumentationType: string implements HasLabel
{
    case Documentation = 'documentation';
    case Registration = 'registration';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Documentation => 'Demo Documentation',
            self::Registration => 'Registration Demo',
        };
    }

    public function storageDirectory(): string
    {
        return match ($this) {
            self::Documentation => 'demos',
            self::Registration => 'registration-demos',
        };
    }

    public function downloadBaseName(): string
    {
        return match ($this) {
            self::Documentation => 'Gymivida-Demo-Documentation',
            self::Registration => 'Gymivida-Registration-Demo',
        };
    }

    /**
     * @return list<string>
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
