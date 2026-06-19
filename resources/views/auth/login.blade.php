<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <label for="email" class="label">{{ __('Email') }}</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" class="input-field">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <label for="password" class="label">{{ __('Password') }}</label>
            <input id="password" type="password" name="password" required autocomplete="current-password" class="input-field">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between">
            <label for="remember_me" class="flex items-center gap-2 cursor-pointer">
                <input id="remember_me" type="checkbox" class="rounded-lg border-sage-300 text-forest-600 focus:ring-forest-500" name="remember">
                                <span class="text-sm text-sage-600">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm text-forest-600 hover:text-forest-700 font-medium underline-offset-2 hover:underline">
                        {{ __('Forgot password?') }}
                    </a>
            @endif
        </div>

        <button type="submit" class="btn-primary w-full justify-center py-3.5">
            {{ __('Log in') }}
        </button>

        <p class="text-center text-sm text-sage-500">
            {{ __("Don't have an account?") }}
            <a href="{{ route('register') }}" class="text-forest-600 hover:text-forest-700 font-semibold">{{ __('Register') }}</a>
        </p>
    </form>
</x-guest-layout>
