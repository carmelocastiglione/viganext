<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Google OAuth routes
Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('oauth.google');
Route::get('/auth/google/callback', [GoogleController::class, 'callback']);

require __DIR__.'/settings.php';
