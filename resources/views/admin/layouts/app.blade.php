<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
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
    @stack('styles')
</head>
<body class="font-sans antialiased bg-cream text-ink selection:bg-forest-600 selection:text-cream">
    <div class="grain-overlay"></div>

    <div class="flex min-h-screen">
        {{-- Sidebar --}}
        <aside class="w-64 bg-white/95 backdrop-blur-sm border-r border-sage-200 flex flex-col shrink-0 relative z-10">
            <div class="p-6 border-b border-sage-100">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2.5">
                    <span class="font-serif text-xl text-forest-600 font-bold tracking-tight">{{ __('Admin') }}</span>
                    <span class="px-2 py-0.5 rounded text-[10px] font-semibold bg-gold-100 text-gold-700 uppercase tracking-wider">{{ config('app.name', 'EcoLife Hub') }}</span>
                </a>
            </div>
            <nav class="flex-1 p-3 space-y-0.5">
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-200
                    {{ request()->routeIs('admin.dashboard') ? 'bg-forest-100 text-forest-700 font-semibold' : 'text-sage-600 hover:bg-sage-100 hover:text-sage-800' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    {{ __('Dashboard') }}
                </a>
                <a href="{{ route('admin.articles.index') }}"
                    class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-200
                    {{ request()->routeIs('admin.articles.*') ? 'bg-forest-100 text-forest-700 font-semibold' : 'text-sage-600 hover:bg-sage-100 hover:text-sage-800' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                    {{ __('Articles') }}
                </a>
                <a href="{{ route('admin.users.index') }}"
                    class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-200
                    {{ request()->routeIs('admin.users.*') ? 'bg-forest-100 text-forest-700 font-semibold' : 'text-sage-600 hover:bg-sage-100 hover:text-sage-800' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m-4.5-8.303a4 4 0 108 0 4 4 0 00-8 0z"/></svg>
                    {{ __('Users') }}
                </a>
                <a href="{{ route('admin.comments.index') }}"
                    class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-200
                    {{ request()->routeIs('admin.comments.*') ? 'bg-forest-100 text-forest-700 font-semibold' : 'text-sage-600 hover:bg-sage-100 hover:text-sage-800' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                    {{ __('Comments') }}
                </a>
                <a href="{{ route('admin.discussions.index') }}"
                    class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-200
                    {{ request()->routeIs('admin.discussions.*') ? 'bg-forest-100 text-forest-700 font-semibold' : 'text-sage-600 hover:bg-sage-100 hover:text-sage-800' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"/></svg>
                    {{ __('Discussions') }}
                </a>
                <a href="{{ route('admin.quiz-questions.index') }}"
                    class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-200
                    {{ request()->routeIs('admin.quiz-questions.*') ? 'bg-forest-100 text-forest-700 font-semibold' : 'text-sage-600 hover:bg-sage-100 hover:text-sage-800' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
                    {{ __('Quiz Questions') }}
                </a>
                <a href="{{ route('admin.data.index') }}"
                    class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-200
                    {{ request()->routeIs('admin.data.*') ? 'bg-forest-100 text-forest-700 font-semibold' : 'text-sage-600 hover:bg-sage-100 hover:text-sage-800' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    {{ __('Data') }}
                </a>
            </nav>
            <div class="p-3 border-t border-sage-100 space-y-0.5">
                <a href="{{ route('dashboard') }}"
                    class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium text-sage-600 hover:bg-sage-100 hover:text-sage-800 transition-all duration-200">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    {{ __('User Dashboard') }}
                </a>
                <a href="{{ route('dashboard') }}"
                    class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium text-sage-600 hover:bg-sage-100 hover:text-sage-800 transition-all duration-200">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    {{ __('Back to App') }}
                </a>
            </div>
        </aside>

        {{-- Main Content --}}
        <div class="flex-1 flex flex-col min-w-0">
            <header class="bg-white/80 backdrop-blur-md border-b border-sage-200 px-8 py-4 sticky top-0 z-20">
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
            <main class="flex-1 p-8">
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
