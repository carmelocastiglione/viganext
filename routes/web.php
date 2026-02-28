<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::view('mercatino', 'mercatino')->name('mercatino');
    Route::view('vigaspecialweek', 'vigaspecialweek')->name('vigaspecialweek');
    Route::view('ciclab', 'ciclab')->name('ciclab');
});

// Google OAuth routes
Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('oauth.google');
Route::get('/auth/google/callback', [GoogleController::class, 'callback']);

require __DIR__.'/settings.php';
