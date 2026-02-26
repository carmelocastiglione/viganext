<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    /**
     * Redirect to Google OAuth
     */
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle Google OAuth callback
     * Only allows login if email exists in database
     */
    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            // Verify @issvigano.org domain (only allow @issvigano.org accounts)
            if (Str::doesntEndWith($googleUser->email, '@issvigano.org')) {
                return redirect('/login')->with('error', 'Sono consentiti solo account @issvigano.org');
            }

            // Search for user by email (only allow login if email exists in database)
            $user = User::where('email', $googleUser->email)->first();
            
            if (!$user) {
                Log::warning('Tentativo di login Google SSO per email non esistente', [
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                ]);
                return redirect('/login')->with('error', 'Email non trovata nel sistema. Contatta l\'amministratore.');
            }

            // Update Google tokens
            $user->update([
                'google_id' => $googleUser->id,
                'google_token' => $googleUser->token,
                'google_refresh_token' => $googleUser->refreshToken,
            ]);

            Auth::login($user, remember: true);
            return redirect('/dashboard');

        } catch (\Exception $e) {
            Log::error('Google SSO authentication error', [
                'error' => $e->getMessage(),
            ]);
            return redirect('/login')->with('error', 'Autenticazione Google fallita. Riprova più tardi.');
        }
    }
}

