<?php

namespace App\Observers;

use App\Models\Documentation;
use App\Models\Faq;

class DocumentationObserver
{
    public function saved(Documentation $documentation): void
    {
        Faq::forgetPublicCaches();
    }

    public function deleted(Documentation $documentation): void
    {
        Faq::forgetPublicCaches();
    }
}
