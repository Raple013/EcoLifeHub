<x-app-layout>
    <x-slot name="header">
        <h2 class="font-display text-2xl text-forest-800">&#128100; {{ __('Profile') }}</h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="card p-8">
                @include('profile.partials.update-profile-information-form')
            </div>

            <div class="card p-8">
                @include('profile.partials.update-password-form')
            </div>

            <div class="card p-8">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>
