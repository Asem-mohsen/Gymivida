<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\RegistrationApiController;
use App\Http\Controllers\RegistrationController;
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

Route::prefix('api/v1/registration')
    ->middleware('throttle:60,1')
    ->controller(RegistrationApiController::class)
    ->group(function () {
        Route::post('/start', 'start')->name('registration.api.start');
        Route::get('/current', 'show')->name('registration.api.current');
        Route::post('/draft', 'saveDraft')->name('registration.api.draft');
        Route::post('/step', 'submitStep')->name('registration.api.step');
        Route::post('/upload', 'upload')->name('registration.api.upload');
        Route::post('/submit', 'submit')->name('registration.api.submit');
    });

// Localized routes
Route::prefix('{locale}')->where(['locale' => 'en|ar'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/privacy', [HomeController::class, 'privacy'])->name('privacy');
    Route::get('/terms', [HomeController::class, 'terms'])->name('terms');
    Route::get('/faq', [HomeController::class, 'faqs'])->name('faqs');
    Route::get('/service-details', [HomeController::class, 'serviceDetails'])->name('serviceDetails');
    Route::get('/portfolio-details', [HomeController::class, 'portfolioDetails'])->name('portfolioDetails');

    Route::get('/register', [RegistrationController::class, 'show'])->name('registration.show');
    Route::get('/register/success', [RegistrationController::class, 'success'])->name('registration.success');
});
