<x-guest-layout>
    <div class="mb-4 text-sm text-sage-600">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-5">
        @csrf

        <div>
            <label for="password" class="label">{{ __('Password') }}</label>
            <input id="password" type="password" name="password" required autocomplete="current-password" class="input-field">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <button type="submit" class="btn-primary w-full justify-center py-3.5">
            {{ __('Confirm') }}
        </button>
    </form>
</x-guest-layout>
