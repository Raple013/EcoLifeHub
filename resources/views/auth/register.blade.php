<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <div>
            <label for="name" class="label">{{ __('Name') }}</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" class="input-field">
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <label for="email" class="label">{{ __('Email') }}</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" class="input-field">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <label for="password" class="label">{{ __('Password') }}</label>
            <input id="password" type="password" name="password" required autocomplete="new-password" class="input-field">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <label for="password_confirmation" class="label">{{ __('Confirm Password') }}</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" class="input-field">
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <button type="submit" class="btn-primary w-full justify-center py-3.5">
            {{ __('Register') }}
        </button>

        <p class="text-center text-sm text-sage-500">
            {{ __('Already have an account?') }}
            <a href="{{ route('login') }}" class="text-forest-600 hover:text-forest-700 font-semibold">{{ __('Log in') }}</a>
        </p>
    </form>
</x-guest-layout>
