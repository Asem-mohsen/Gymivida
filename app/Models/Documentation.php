<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documentation extends Model
{
    protected $fillable = [
        'type',
        'file_path',
        'file_name',
    ];

    /**
     * Get documentation by type.
     */
    public static function getByType(string $type): ?self
    {
        return static::where('type', $type)->first();
    }

    /**
     * Get the URL to download the file via the app (avoids /storage/ being handled by Laravel and returning HTML).
     */
    public function getFileUrlAttribute(): ?string
    {
        if (!$this->file_path) {
            return null;
        }

        return route('download.documentation', ['type' => $this->type]);
    }
}
