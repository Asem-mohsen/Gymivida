<?php

namespace App\Models;

use App\Enums\FaqKind;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Faq extends Model
{
    protected $fillable = [
        'kind',
        'sort_order',
        'question_en',
        'question_ar',
        'answer_en',
        'answer_ar',
        'documentation_type',
    ];

    protected $casts = [
        'kind' => FaqKind::class,
        'sort_order' => 'integer',
    ];

    public function questionForLocale(?string $locale = null): string
    {
        $locale = $locale ?? app()->getLocale();

        return $locale === 'ar' ? $this->question_ar : $this->question_en;
    }

    public function answerForLocale(?string $locale = null): ?string
    {
        $locale = $locale ?? app()->getLocale();

        return $locale === 'ar' ? $this->answer_ar : $this->answer_en;
    }

    public static function forgetPublicCaches(): void
    {
        foreach (['en', 'ar'] as $locale) {
            Cache::forget('home_page_data_' . $locale);
            Cache::forget('faqs_page_data_' . $locale);
        }
    }
}
