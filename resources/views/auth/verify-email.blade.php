<x-guest-layout>
    <div class="mb-4 text-sm text-sage-600">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="space-y-4">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn-primary w-full justify-center py-3.5">
                {{ __('Resend Verification Email') }}
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-secondary w-full justify-center py-3.5">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout>
