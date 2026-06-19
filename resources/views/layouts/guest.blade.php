<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'EcoLife Hub') }} — Sustainable Living Platform</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=playfair-display:400,500,600,700|dm-sans:400,400i,500,600,700&display=swap" rel="stylesheet" />
        <link rel="icon" type="image/svg+xml" href="/favicon.svg">
        <link rel="alternate icon" href="/favicon.ico">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-cream text-ink selection:bg-forest-600 selection:text-cream">
        <div class="grain-overlay"></div>
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-cream via-white to-sage-50">
            <div class="w-full sm:max-w-md mt-6 px-8 py-8 bg-white/80 backdrop-blur-md shadow-card rounded-2xl border border-sage-100/70">
                <div class="mb-6 text-center">
                    <a href="/">
                        <x-application-logo />
                    </a>
                </div>

                {{ $slot }}
            </div>

            <div class="mt-4">
                <form action="{{ route('language.switch', app()->getLocale() === 'id' ? 'en' : 'id') }}" method="POST" class="text-center">
                    @csrf
                    <button type="submit" class="px-4 py-2 rounded-xl text-xs font-semibold border transition-colors
                        {{ app()->getLocale() === 'id' ? 'bg-forest-600 text-white border-forest-600' : 'bg-sage-100 text-sage-700 border-sage-200 hover:bg-sage-200' }}">
                        {{ app()->getLocale() === 'id' ? 'English' : 'Bahasa Indonesia' }}
                    </button>
                </form>
            </div>

            <p class="mt-4 text-xs text-sage-400 text-center">
                {{ __('Small Actions, Sustainable Future') }}
            </p>
        </div>

        @stack('scripts')
    </body>
</html>
