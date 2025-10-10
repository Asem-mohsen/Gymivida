<?php

use App\Http\Controllers\ContactUsController;
use Illuminate\Support\Facades\Route;


Route::prefix('v1')->group(function () {
    Route::post('/contact', [ContactUsController::class, 'store']);
});

