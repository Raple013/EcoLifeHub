<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', config('app.name', 'EcoLife Hub')) — Sustainable Living Platform</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=playfair-display:400,500,600,700|dm-sans:400,400i,500,600,700&display=swap" rel="stylesheet" />
        <link rel="icon" type="image/svg+xml" href="/favicon.svg">
        <link rel="alternate icon" href="/favicon.ico">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-ink bg-cream selection:bg-forest-600 selection:text-cream">
        <div class="grain-overlay"></div>

        <div class="min-h-screen">
            @include('layouts.navigation')

            @isset($header)
                <header class="border-b border-sage-100 bg-white/80 backdrop-blur-sm">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main>
                {{ $slot }}
            </main>

            <footer class="border-t border-sage-100 bg-white/50">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
                    <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                        <div>
                            <a href="{{ route('dashboard') }}" class="font-serif text-lg text-forest-600 tracking-tight">EcoLife Hub</a>
                            <p class="text-xs text-muted/60 mt-1">{{ __('Track your journey to a sustainable future.') }}</p>
                        </div>
                        <div class="flex items-center gap-6 text-xs text-muted/60">
                            <a href="{{ route('learning') }}" class="hover:text-forest-600 transition-colors">{{ __('Learn') }}</a>
                            <a href="{{ route('quiz') }}" class="hover:text-forest-600 transition-colors">{{ __('Quiz') }}</a>
                            <a href="{{ route('discussions.index') }}" class="hover:text-forest-600 transition-colors">{{ __('Discuss') }}</a>
                            <span>&copy; {{ date('Y') }}</span>
                        </div>
                    </div>
                </div>
            </footer>
        </div>

        @stack('scripts')
    </body>
</html>
