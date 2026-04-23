<?php

namespace App\Observers;

use App\Models\Faq;

class FaqObserver
{
    public function saved(Faq $faq): void
    {
        Faq::forgetPublicCaches();
    }

    public function deleted(Faq $faq): void
    {
        Faq::forgetPublicCaches();
    }
}
