@extends('admin.layouts.app')

@section('title', $user->name)
@section('breadcrumb', $user->name)

@php
    $avatarColors = [
        'bg' => ['bg-forest-100', 'bg-gold-100', 'bg-sage-200', 'bg-rose-100', 'bg-sky-100', 'bg-amber-100', 'bg-emerald-100', 'bg-indigo-100'],
        'text' => ['text-forest-700', 'text-gold-700', 'text-sage-700', 'text-rose-700', 'text-sky-700', 'text-amber-700', 'text-emerald-700', 'text-indigo-700'],
    ];
    $ci = abs(crc32($user->name)) % 8;
@endphp

@section('content')
    <div class="space-y-8">
        {{-- Back link --}}
        <a href="{{ route('admin.users.index') }}" class="animate-fade-up inline-flex items-center gap-2 text-sage-400 hover:text-forest-600 text-sm font-medium transition-colors group">
            <svg class="w-4 h-4 transition-transform group-hover:-translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            {{ __('Back to all users') }}
        </a>

        {{-- Profile Hero Card --}}
        <div class="animate-fade-up" style="animation-delay: 0.05s">
            <div class="bg-white rounded-2xl shadow-[0_2px_16px_-6px_rgba(40,60,40,0.1)] border border-sage-100 overflow-hidden">
                {{-- Decorative top bar --}}
                <div class="h-2 bg-gradient-to-r from-forest-500 via-gold-400 to-forest-300"></div>

                <div class="p-6 md:p-8">
                    <div class="flex flex-col md:flex-row md:items-center gap-5">
                        {{-- Avatar --}}
                        <div class="relative shrink-0">
                            <div class="w-20 h-20 md:w-24 md:h-24 rounded-2xl {{ $avatarColors['bg'][$ci] }} flex items-center justify-center text-3xl md:text-4xl font-bold {{ $avatarColors['text'][$ci] }} shadow-md">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            @if ($user->isBlocked())
                                <div class="absolute -top-1 -right-1 w-6 h-6 rounded-full bg-red-500 border-2 border-white flex items-center justify-center shadow-sm">
                                    <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"/></svg>
                                </div>
                            @else
                                <div class="absolute -top-1 -right-1 w-6 h-6 rounded-full bg-emerald-500 border-2 border-white flex items-center justify-center shadow-sm">
                                    <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                </div>
                            @endif
                        </div>

                        {{-- Info --}}
                        <div class="flex-1 min-w-0">
                            <div class="flex flex-wrap items-center gap-3 mb-1.5">
                                <h1 class="font-serif text-2xl md:text-3xl text-ink tracking-tight">{{ $user->name }}</h1>
                                @if ($user->hasRole('admin'))
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                        {{ __('Admin') }}
                                    </span>
                                @endif
                                @if ($user->isBlocked())
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg text-xs font-semibold bg-red-50 text-red-600 border border-red-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                        {{ __('Blocked') }}
                                    </span>
                                @endif
                            </div>
                            <p class="text-sage-500 text-sm">{{ $user->email }}</p>
                            <p class="text-sage-400 text-xs mt-1">{{ __('Joined') }} {{ $user->created_at->format('M j, Y') }} &middot; {{ $user->created_at->diffForHumans() }}</p>
                        </div>

                        {{-- Block/Unblock Action --}}
                        <div class="shrink-0 relative">
                            @if ($user->hasRole('admin'))
                                <span class="text-xs text-sage-400 italic">{{ __('Admin accounts cannot be blocked.') }}</span>
                            @elseif ($user->isBlocked())
                                <form action="{{ route('admin.users.unblock', $user) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full md:w-auto px-5 py-2.5 bg-emerald-600 text-cream rounded-xl text-sm font-semibold hover:bg-emerald-700 transition-all duration-200 shadow-sm active:scale-[0.97] inline-flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        {{ __('Unblock User') }}
                                    </button>
                                </form>
                            @else
                                <div x-data="{ open: false }">
                                    <button @click="open = !open"
                                       class="w-full md:w-auto px-5 py-2.5 bg-red-500 text-cream rounded-xl text-sm font-semibold hover:bg-red-600 transition-all duration-200 shadow-sm active:scale-[0.97] inline-flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636"/></svg>
                                        {{ __('Block User') }}
                                    </button>
                                    <div x-show="open" @click.outside="open = false" x-cloak class="absolute mt-2 right-0 md:right-auto bg-white border border-sage-200 rounded-xl p-4 shadow-xl z-10 min-w-[200px]">
                                        <form action="{{ route('admin.users.block', $user) }}" method="POST">
                                            @csrf
                                            <p class="text-xs text-sage-500 mb-3">{{ __('Are you sure you want to block this user?') }}</p>
                                            <div class="flex gap-2">
                                                <button type="submit" class="flex-1 px-4 py-2 bg-red-500 text-white rounded-lg text-xs font-semibold hover:bg-red-600 transition-colors">{{ __('Block') }}</button>
                                                <button type="button" @click="open = false" class="px-4 py-2 text-sage-500 hover:text-ink text-xs font-medium transition-colors rounded-lg hover:bg-sage-50">{{ __('Cancel') }}</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>


                </div>
            </div>
        </div>

        {{-- Stats Grid --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 animate-fade-up" style="animation-delay: 0.1s">
            <div class="bg-white rounded-2xl p-5 shadow-[0_2px_12px_-4px_rgba(40,60,40,0.08)] border border-sage-100 border-t-4 border-t-forest-400">
                <p class="stat-value text-lg md:text-2xl">{{ $user->bmi() ? number_format($user->bmi(), 1) : '-' }}</p>
                <p class="stat-label mt-1 text-sage-500">{{ __('BMI') }}</p>
            </div>
            <div class="bg-white rounded-2xl p-5 shadow-[0_2px_12px_-4px_rgba(40,60,40,0.08)] border border-sage-100 border-t-4 border-t-gold-400">
                <p class="stat-value text-lg md:text-2xl">{{ $user->weight_kg ?? '-' }}</p>
                <p class="stat-label mt-1 text-sage-500">{{ __('Weight') }} <span class="text-sage-400">(kg)</span></p>
            </div>
            <div class="bg-white rounded-2xl p-5 shadow-[0_2px_12px_-4px_rgba(40,60,40,0.08)] border border-sage-100 border-t-4 border-t-sage-400">
                <p class="stat-value text-lg md:text-2xl">{{ $user->height_cm ?? '-' }}</p>
                <p class="stat-label mt-1 text-sage-500">{{ __('Height') }} <span class="text-sage-400">(cm)</span></p>
            </div>
            <div class="bg-white rounded-2xl p-5 shadow-[0_2px_12px_-4px_rgba(40,60,40,0.08)] border border-sage-100 border-t-4 border-t-amber-400">
                <p class="stat-value text-lg md:text-2xl">{{ $user->city ?? '-' }}</p>
                <p class="stat-label mt-1 text-sage-500">{{ __('City') }}</p>
            </div>
        </div>

        {{-- Daily History --}}
        @if ($histories->count() > 0)
            <div class="animate-fade-up" style="animation-delay: 0.15s">
                <div class="bg-white rounded-2xl shadow-[0_2px_16px_-6px_rgba(40,60,40,0.1)] border border-sage-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-sage-100 flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-lg bg-forest-50 flex items-center justify-center">
                            <svg class="w-4 h-4 text-forest-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                        <div>
                            <h2 class="font-semibold text-forest-700 text-sm">{{ __('Daily History') }}</h2>
                            <p class="text-xs text-sage-400">{{ __('Last 10 entries') }}</p>
                        </div>
                    </div>
                    <div class="divide-y divide-sage-100">
                        @foreach ($histories as $h)
                            <div class="px-6 py-4 flex items-center justify-between text-sm hover:bg-sage-50/40 transition-colors group">
                                <div class="flex items-center gap-3">
                                    <span class="w-2 h-2 rounded-full bg-forest-300 group-hover:bg-forest-500 transition-colors shrink-0"></span>
                                    <span class="text-sage-600">{{ $h->history_date->format('M j, Y') }}</span>
                                    <span class="text-sage-300 text-xs">{{ $h->history_date->diffForHumans() }}</span>
                                </div>
                                <div class="flex items-center gap-5 text-xs">
                                    <span class="flex items-center gap-1.5 text-gold-600">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
                                        {{ $h->quiz_score }}%
                                    </span>
                                    <span class="flex items-center gap-1.5 text-forest-600">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                        {{ $h->activity_minutes }}min
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        {{-- Activities --}}
        @if ($activities->count() > 0)
            <div class="animate-fade-up" style="animation-delay: 0.2s">
                <div class="bg-white rounded-2xl shadow-[0_2px_16px_-6px_rgba(40,60,40,0.1)] border border-sage-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-sage-100 flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-lg bg-gold-50 flex items-center justify-center">
                            <svg class="w-4 h-4 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        </div>
                        <div>
                            <h2 class="font-semibold text-forest-700 text-sm">{{ __('Activities') }}</h2>
                            <p class="text-xs text-sage-400">{{ __('Last 10 entries') }}</p>
                        </div>
                    </div>
                    <div class="divide-y divide-sage-100">
                        @foreach ($activities as $a)
                            <div class="px-6 py-4 flex items-center justify-between text-sm hover:bg-sage-50/40 transition-colors group">
                                <div class="flex items-center gap-3">
                                    <span class="w-2 h-2 rounded-full bg-gold-300 group-hover:bg-gold-500 transition-colors shrink-0"></span>
                                    <div>
                                        <span class="text-forest-700 font-medium capitalize">{{ str_replace('_', ' ', $a->activity_type) }}</span>
                                        <span class="text-sage-400 ml-2 text-xs">{{ $a->activity_date->diffForHumans() }}</span>
                                    </div>
                                </div>
                                <span class="text-clay-500 text-xs flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    {{ $a->duration_minutes }}min
                                    @if($a->calories_burned)
                                        <span class="text-sage-400">&bull; {{ $a->calories_burned }}kcal</span>
                                    @endif
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        {{-- Empty state when no data --}}
        @if ($histories->count() === 0 && $activities->count() === 0)
            <div class="animate-fade-up text-center py-12" style="animation-delay: 0.15s">
                <div class="w-16 h-16 rounded-2xl bg-sage-100 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-sage-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                </div>
                <p class="text-sage-500 text-sm font-medium">{{ __('No activity or history data yet.') }}</p>
                <p class="text-sage-400 text-xs mt-1">{{ __('Data will appear as the user engages with the platform.') }}</p>
            </div>
        @endif
    </div>
@endsection