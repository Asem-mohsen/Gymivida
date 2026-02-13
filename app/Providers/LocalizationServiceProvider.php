<?php

namespace App\Providers;

use App\Support\Localization;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class LocalizationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(Localization::class, function ($app) {
            return new Localization();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            // Do not share localization with Filament views — they use $direction for grid (row/column)
            if (str_contains($view->name(), 'filament')) {
                return;
            }

            $localization = app(Localization::class);

            $view->with([
                'currentLocale' => $localization->getCurrentLocale(),
                'direction' => $localization->getDirection(),
                'isRtl' => $localization->isRtl(),
                'supportedLocales' => $localization->getSupportedLocales(),
            ]);
        });
    }
}
