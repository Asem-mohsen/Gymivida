<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'monthly_price',
        'yearly_price',
        'is_active',
    ];

    protected $casts = [
        'monthly_price' => 'decimal:2',
        'yearly_price' => 'decimal:2',
        'is_active' => 'boolean',
    ];


    public function features(): BelongsToMany
    {
        return $this->belongsToMany(Feature::class)->withPivot('order')->withTimestamps()->orderByPivot('order');
    }

}
