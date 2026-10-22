<?php

namespace App\Models;

use App\Enums\AppLocale;
use App\Enums\DocumentationType;
use Illuminate\Database\Eloquent\Model;

class Documentation extends Model
{
    protected $fillable = [
        'type',
        'locale',
        'file_path',
        'file_name',
    ];

    protected $casts = [
        'type' => DocumentationType::class,
        'locale' => AppLocale::class,
    ];

    /**
     * Get documentation by type for a locale, falling back to English when missing.
     */
    public static function getByType(string $type, ?string $locale = null): ?self
    {
        $resolvedLocale = AppLocale::normalize($locale)->value;

        $documentation = static::query()
            ->where('type', $type)
            ->where('locale', $resolvedLocale)
            ->first();

        if ($documentation || $resolvedLocale === AppLocale::En->value) {
            return $documentation;
        }

        return static::query()
            ->where('type', $type)
            ->where('locale', AppLocale::En->value)
            ->first();
    }

    /**
     * Download URL for this documentation (includes locale for language-aware PDFs).
     */
    public function getFileUrlAttribute(): ?string
    {
        if (!$this->file_path) {
            return null;
        }

        $type = $this->type instanceof DocumentationType
            ? $this->type->value
            : (string) $this->type;

        $locale = $this->locale instanceof AppLocale
            ? $this->locale->value
            : AppLocale::normalize($this->locale)->value;

        return route('download.documentation', [
            'type' => $type,
            'locale' => $locale,
        ]);
    }
}
