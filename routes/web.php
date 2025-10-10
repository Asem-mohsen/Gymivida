<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/privacy', [HomeController::class, 'privacy'])->name('privacy');
Route::get('/terms', [HomeController::class, 'terms'])->name('terms');
Route::get('/service-details', [HomeController::class, 'serviceDetails'])->name('serviceDetails');
Route::get('/portfolio-details', [HomeController::class, 'portfolioDetails'])->name('portfolioDetails');