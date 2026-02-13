<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocaleController;
use Illuminate\Support\Facades\Route;

// Redirect root to default locale
Route::get('/', function () {
    return redirect('/' . config('app.fallback_locale', 'en'));
});

// Locale switcher route
Route::post('/locale/switch', [LocaleController::class, 'switch'])->name('locale.switch');

// Download route: no locale prefix so it always hits Laravel and returns the PDF (not HTML)
Route::get('/download/documentation/{type}', [HomeController::class, 'downloadDocumentation'])
    ->where('type', 'documentation|registration')
    ->name('download.documentation');

// Localized routes
Route::prefix('{locale}')->where(['locale' => 'en|ar'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/privacy', [HomeController::class, 'privacy'])->name('privacy');
    Route::get('/terms', [HomeController::class, 'terms'])->name('terms');
    Route::get('/service-details', [HomeController::class, 'serviceDetails'])->name('serviceDetails');
    Route::get('/portfolio-details', [HomeController::class, 'portfolioDetails'])->name('portfolioDetails');
});
