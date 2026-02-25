<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/auth/google', function () {
    return Socialite::driver('google')->redirect();
})->name('oauth.google');

Route::get('/auth/callback/google', function () {
    $user = Socialite::driver('google')->user();
    // Verify @issvigano.org domain
    if (!str_ends_with($user->email, '@issvigano.org')) {
        return redirect('/login')->with('status', 'Only @issvigano.org accounts allowed');
    }
    // Handle user authentication
});

require __DIR__.'/settings.php';
