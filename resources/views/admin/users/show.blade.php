@extends('admin.layouts.app')

@section('title', $user->name)
@section('breadcrumb', $user->name)

@section('content')
    <div class="space-y-6">
        <a href="{{ route('admin.users.index') }}" class="inline-flex items-center gap-1.5 text-muted hover:text-forest-600 text-sm font-medium transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            {{ __('Back to Users') }}
        </a>

        <div class="card p-6">
            <div class="flex items-center gap-4 mb-6">
                <div class="w-14 h-14 rounded-full bg-forest-100 flex items-center justify-center text-2xl font-bold text-forest-700">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <div>
                    <h1 class="font-serif text-2xl text-ink tracking-tight">{{ $user->name }}</h1>
                    <p class="text-muted text-sm">{{ $user->email }}</p>
                </div>
                @if ($user->hasRole('admin'))
                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-forest-100 text-forest-700 ml-auto">{{ __('Admin') }}</span>
                @endif
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-sage-50 rounded-xl p-4 text-center">
                    <p class="stat-value text-lg md:text-2xl">{{ $user->bmi() ? number_format($user->bmi(), 1) : '-' }}</p>
                    <p class="stat-label mt-1">{{ __('BMI') }}</p>
                </div>
                <div class="bg-sage-50 rounded-xl p-4 text-center">
                    <p class="stat-value text-lg md:text-2xl">{{ $user->weight_kg ?? '-' }}</p>
                    <p class="stat-label mt-1">{{ __('Weight') }} (kg)</p>
                </div>
                <div class="bg-sage-50 rounded-xl p-4 text-center">
                    <p class="stat-value text-lg md:text-2xl">{{ $user->height_cm ?? '-' }}</p>
                    <p class="stat-label mt-1">{{ __('Height') }} (cm)</p>
                </div>
                <div class="bg-sage-50 rounded-xl p-4 text-center">
                    <p class="stat-value text-lg md:text-2xl">{{ $user->city ?? '-' }}</p>
                    <p class="stat-label mt-1">{{ __('City') }}</p>
                </div>
            </div>
        </div>

        {{-- Daily History --}}
        @if ($histories->count() > 0)
            <div class="card overflow-hidden">
                <div class="px-6 py-4 border-b border-sage-100 flex items-center gap-2.5">
                    <svg class="w-5 h-5 text-forest-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <h2 class="font-semibold text-forest-700 text-sm">{{ __('Daily History') }}</h2>
                </div>
                <div class="divide-y divide-sage-100">
                    @foreach ($histories as $h)
                        <div class="px-6 py-3.5 flex items-center justify-between text-sm hover:bg-sage-50/50 transition-colors">
                            <span class="text-sage-600">{{ $h->history_date->diffForHumans() }}</span>
                            <div class="flex items-center gap-4 text-xs text-muted">
                                <span class="flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5 text-gold-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
                                    {{ $h->quiz_score }}%
                                </span>
                                <span class="flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5 text-forest-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                    {{ $h->activity_minutes }}min
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- Activities --}}
        @if ($activities->count() > 0)
            <div class="card overflow-hidden">
                <div class="px-6 py-4 border-b border-sage-100 flex items-center gap-2.5">
                    <svg class="w-5 h-5 text-forest-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    <h2 class="font-semibold text-forest-700 text-sm">{{ __('Activities') }}</h2>
                </div>
                <div class="divide-y divide-sage-100">
                    @foreach ($activities as $a)
                        <div class="px-6 py-3.5 flex items-center justify-between text-sm hover:bg-sage-50/50 transition-colors">
                            <div>
                                <span class="text-forest-700 font-medium">{{ str_replace('_', ' ', $a->activity_type) }}</span>
                                <span class="text-muted ml-2 text-xs">{{ $a->activity_date->diffForHumans() }}</span>
                            </div>
                            <span class="text-clay-600 text-xs flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                {{ $a->duration_minutes }}min
                                @if($a->calories_burned)
                                    <span class="ml-1.5">&bull; {{ $a->calories_burned }}kcal</span>
                                @endif
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection
