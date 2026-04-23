<?php

namespace App\Providers;

use App\Models\Documentation;
use App\Models\Faq;
use App\Models\Service;
use App\Observers\DocumentationObserver;
use App\Observers\FaqObserver;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Faq::observe(FaqObserver::class);
        Documentation::observe(DocumentationObserver::class);

        View::composer('layout.footer.footer', function ($view) {
            $view->with('footerServices', Service::active()->ordered()->take(7)->get());
        });
    }
}
