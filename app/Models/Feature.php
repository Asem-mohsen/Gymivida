<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Feature extends Model
{
    protected $fillable = ['name','description','is_active','is_core'];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)->withPivot('order')->withTimestamps()->orderByPivot('order');
    }
}
