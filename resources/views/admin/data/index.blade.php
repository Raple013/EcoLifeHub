@extends('admin.layouts.app')

@section('title', __('Data Overview'))
@section('breadcrumb', __('Data'))

@section('content')
    <div class="space-y-6">
        <div class="animate-fade-up">
            <h1 class="font-serif text-3xl text-ink tracking-tight">{{ __('Data Overview') }}</h1>
            <p class="text-muted text-sm mt-1.5">{{ __('Platform activity and usage statistics') }}</p>
        </div>

        {{-- Period Tabs --}}
        <div class="flex flex-wrap gap-2 animate-fade-up" style="animation-delay: 0.05s">
            @php $periods = ['today' => __('Today'), 'week' => __('This Week'), 'month' => __('This Month')]; @endphp
            @foreach ($periods as $key => $label)
                <a href="{{ route('admin.data.index', ['period' => $key]) }}"
                    class="px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200
                    {{ $period === $key ? 'bg-forest-600 text-cream shadow-sm' : 'bg-sage-100 text-sage-700 hover:bg-sage-200' }}">
                    {{ $label }}
                </a>
            @endforeach
        </div>

        {{-- Stats --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-5 animate-fade-up" style="animation-delay: 0.1s">
            <div class="card p-5">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-10 h-10 rounded-xl bg-forest-100 flex items-center justify-center">
                        <svg class="w-5 h-5 text-forest-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                </div>
                <p class="stat-value">{{ $totalActivities }}</p>
                <p class="stat-label mt-1">{{ __('Activities Logged') }}</p>
            </div>
            <div class="card p-5">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-10 h-10 rounded-xl bg-gold-100 flex items-center justify-center">
                        <svg class="w-5 h-5 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                </div>
                <p class="stat-value">{{ $totalMinutes }}</p>
                <p class="stat-label mt-1">{{ __('Total Minutes') }}</p>
            </div>
            <div class="card p-5">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-10 h-10 rounded-xl bg-clay-100 flex items-center justify-center">
                        <svg class="w-5 h-5 text-clay-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </div>
                </div>
                <p class="stat-value">{{ number_format($totalCalories) }}</p>
                <p class="stat-label mt-1">{{ __('Calories Burned') }}</p>
            </div>
            <div class="card p-5">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-10 h-10 rounded-xl bg-forest-100 flex items-center justify-center">
                        <svg class="w-5 h-5 text-forest-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m-4.5-8.303a4 4 0 108 0 4 4 0 00-8 0z"/></svg>
                    </div>
                </div>
                <p class="stat-value">{{ $activeUsers }}</p>
                <p class="stat-label mt-1">{{ __('Active Users') }}</p>
            </div>
            <div class="card p-5">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-10 h-10 rounded-xl bg-gold-100 flex items-center justify-center">
                        <svg class="w-5 h-5 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </div>
                </div>
                <p class="stat-value">{{ $totalUsers }}</p>
                <p class="stat-label mt-1">{{ __('Total Users') }}</p>
            </div>
            <div class="card p-5">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-10 h-10 rounded-xl bg-forest-100 flex items-center justify-center">
                        <svg class="w-5 h-5 text-forest-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
                    </div>
                </div>
                <p class="stat-value">{{ $totalQuiz ? number_format($totalQuiz, 0) : '-' }}</p>
                <p class="stat-label mt-1">{{ __('Avg Quiz Score') }}</p>
            </div>
        </div>

        {{-- Top Activities --}}
        @if ($topActivities->count() > 0)
            <div class="card overflow-hidden animate-fade-up" style="animation-delay: 0.15s">
                <div class="px-6 py-4 border-b border-sage-100 flex items-center gap-2.5">
                    <svg class="w-5 h-5 text-forest-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    <h2 class="font-semibold text-forest-700 text-sm">{{ __('Top Activities') }}</h2>
                </div>
                <div class="divide-y divide-sage-100">
                    @foreach ($topActivities as $act)
                        <div class="px-6 py-3.5 flex items-center justify-between text-sm hover:bg-sage-50/50 transition-colors">
                            <span class="text-forest-700 font-medium capitalize">{{ str_replace('_', ' ', $act->activity_type) }}</span>
                            <div class="flex items-center gap-4 text-xs text-muted">
                                <span class="flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                                    {{ $act->total }}x
                                </span>
                                <span class="flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    {{ $act->minutes }} min
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection
