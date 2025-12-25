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
     * Get the URL for the file.
     */
    public function getFileUrlAttribute(): ?string
    {
        if (!$this->file_path) {
            return null;
        }

        // Use route to download via controller for proper file serving
        return route('download.documentation', ['type' => $this->type]);
    }
}
