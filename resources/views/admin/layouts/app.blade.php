<!DOCTYPE html>
{{-- PAKSA HTML: Menggunakan inline style !important agar tidak bisa di-override oleh css lain --}}
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="height: 100vh !important; overflow: hidden !important;">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') — {{ config('app.name', 'EcoLife Hub') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=playfair-display:400,500,600,700|dm-sans:400,400i,500,600,700&display=swap" rel="stylesheet" />
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <link rel="alternate icon" href="/favicon.ico">
    @vite('resources/css/app.css')
    <style>[x-cloak] { display: none !important; }</style>
    @stack('styles')
</head>

{{-- PAKSA BODY: Menggunakan inline style !important agar layar utama benar-benar mati/tidak bisa scroll --}}
<body class="font-sans antialiased bg-cream text-ink selection:bg-forest-600 selection:text-cream" style="height: 100vh !important; overflow: hidden !important;">
    <div class="grain-overlay"></div>

    {{-- WRAPPER UTAMA KIRI-KANAN --}}
    <div class="flex h-full w-full overflow-hidden">
        
        {{-- 1. Panggil komponen Sidebar --}}
        @include('components.sidebar')

        {{-- 2. KOLOM KANAN (Header & Konten Utama) --}}
        {{-- KUNCINYA DI SINI: Ditambahkan 'min-h-0' dan 'overflow-hidden' agar flexbox mengunci tingginya sebatas layar! --}}
        <div class="flex-1 flex flex-col h-full min-h-0 overflow-hidden bg-cream relative">
            
            {{-- Header Tetap Diam di Atas --}}
            <header class="shrink-0 bg-white/80 backdrop-blur-md border-b border-sage-200 px-8 py-4 z-20">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-sage-500 font-medium">
                        @yield('breadcrumb', __('Dashboard'))
                    </div>
                    <div class="flex items-center gap-4 text-sm">
                        <span class="text-sage-500">{{ auth()->user()->name }}</span>
                        <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-forest-100 text-forest-700">{{ __('Admin') }}</span>
                    </div>
                </div>
            </header>

            {{-- AREA KONTEN UTAMA (KUNCINYA DI SINI: Ditambahkan 'min-h-0') --}}
            {{-- Sekarang area inilah satu-satunya bagian di website yang bisa di-scroll naik turun --}}
            <main class="flex-1 overflow-y-auto min-h-0 p-8">
                @if (session('success'))
                    <div class="mb-6 flex items-center gap-2.5 bg-green-50 border border-green-200 text-green-700 px-5 py-4 rounded-xl text-sm font-medium shadow-sm">
                        <svg class="w-5 h-5 shrink-0 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="mb-6 flex items-center gap-2.5 bg-red-50 border border-red-200 text-red-700 px-5 py-4 rounded-xl text-sm font-medium shadow-sm">
                        <svg class="w-5 h-5 shrink-0 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </main>
            
        </div>
    </div>

    @vite('resources/js/app.js')
    @stack('scripts')
</body>
</html>