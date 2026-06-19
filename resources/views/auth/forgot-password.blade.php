<x-guest-layout>
    <div class="mb-4 text-sm text-sage-600">
        {{ __("Forgot your password? No problem. Just let us know your email address and we will email you a password reset link.") }}
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
        @csrf

        <div>
            <label for="email" class="label">{{ __('Email') }}</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus class="input-field">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <button type="submit" class="btn-primary w-full justify-center py-3.5">
            {{ __('Email Password Reset Link') }}
        </button>
    </form>
</x-guest-layout>
