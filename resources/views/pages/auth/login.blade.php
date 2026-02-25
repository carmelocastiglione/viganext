<x-layouts::auth>
    <div class="flex items-center justify-center p-4">
        <div class="w-full max-w-5xl">
            <!-- Header -->
            <div class="text-center mb-12">
                <flux:heading size="xl">Entra con il tuo account</flux:heading>
                <flux:text class="mt-2">Scegli il metodo di accesso preferito</flux:text>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="text-center mb-6" :status="session('status')" />

            <!-- Two Column Layout -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 auto-rows-fr">
                <!-- Left Column: Google Login -->
                <div class="bg-white rounded-lg shadow-lg p-8 flex flex-col justify-center border border-slate-200">
                    <flux:heading size="lg" class="mb-4 text-center">
                        Accedi con Google
                    </flux:heading>
                    <flux:text class="mb-6 text-center">
                        Accedi con il tuo account @issvigano.org
                    </flux:text>
                    
                    <!-- Google OAuth Button -->
                    <x-oauth-google-button href="{{ route('oauth.google') }}" />

                    <flux:text class="text-xs text-center mt-4">
                        Accesso consentito solo per gli account @issvigano.org
                    </flux:text>
                </div>

                <!-- Right Column: Email/Password Login -->
                <div class="bg-white rounded-lg shadow-lg p-8 border border-slate-200 flex flex-col">
                    <flux:heading size="lg" class="mb-4 text-center">
                        Accedi con Email
                    </flux:heading>

                    <form method="POST" action="{{ route('login.store') }}" class="flex flex-col gap-6">
                        @csrf

                        <!-- Email Address -->
                        <flux:input
                            name="email"
                            :label="__('Indirizzo email')"
                            :value="old('email')"
                            type="email"
                            required
                            autofocus
                            autocomplete="email"
                            placeholder="email@example.com"
                        />

                        <!-- Password -->
                        <div class="relative">
                            <flux:input
                                name="password"
                                :label="__('Password')"
                                type="password"
                                required
                                autocomplete="current-password"
                                :placeholder="__('Password')"
                                viewable
                            />

                            @if (Route::has('password.request'))
                                <flux:link class="absolute top-0 text-sm end-0" :href="route('password.request')" wire:navigate>
                                    {{ __('Forgot your password?') }}
                                </flux:link>
                            @endif
                        </div>

                        <!-- Remember Me -->
                        <flux:checkbox name="remember" :label="__('Remember me')" :checked="old('remember')" />

                        <div class="flex items-center justify-end">
                            <flux:button variant="primary" type="submit" class="w-full" data-test="login-button">
                                {{ __('Log in') }}
                            </flux:button>
                        </div>
                    </form>

                    @if (Route::has('register'))
                        <div class="space-x-1 text-sm text-center rtl:space-x-reverse text-slate-600 mt-6">
                            <span>{{ __('Don\'t have an account?') }}</span>
                            <flux:link :href="route('register')" wire:navigate>{{ __('Sign up') }}</flux:link>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layouts::auth>
