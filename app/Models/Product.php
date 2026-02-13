<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Translatable\HasTranslations;

class Product extends Model
{
    use HasTranslations;

    protected $fillable = [
        'name',
        'description',
        'monthly_price',
        'yearly_price',
        'trial_period_days',
        'is_active',
    ];

    protected $casts = [
        'monthly_price' => 'decimal:2',
        'yearly_price' => 'decimal:2',
        'trial_period_days' => 'integer',
        'is_active' => 'boolean',
    ];

    public $translatable = ['name', 'description'];

    public function features(): BelongsToMany
    {
        return $this->belongsToMany(Feature::class)->withPivot(['order', 'limit'])->withTimestamps()->orderByPivot('order');
    }
}
