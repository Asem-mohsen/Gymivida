<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Translatable\HasTranslations;

class Feature extends Model
{
    use HasTranslations;

    protected $fillable = ['name', 'key', 'description', 'is_active', 'is_core', 'is_hidden'];

    public $translatable = ['name', 'description'];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)->withPivot(['order', 'limit'])->withTimestamps()->orderByPivot('order');
    }
}
