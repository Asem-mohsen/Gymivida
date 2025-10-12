<?php

use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\FeatureController;
use Illuminate\Support\Facades\Route;


Route::prefix('v1')->group(function () {
    Route::post('/contact', [ContactUsController::class, 'store']);
    Route::get('/products', [ProductController::class, 'getActiveProducts']);
    Route::get('/products/{id}', [ProductController::class, 'getActiveProductById']);

    Route::post('/features', [FeatureController::class, 'getActiveFeatures']);
    Route::post('/verify-registration-token', [ContactUsController::class, 'verifyToken']);
});

