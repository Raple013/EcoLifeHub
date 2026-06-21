@extends('admin.layouts.app')

@section('title', __('Dashboard'))
@section('breadcrumb', __('Dashboard'))

@section('content')
    <div class="space-y-8">
        <div class="animate-fade-up">
            <h1 class="font-serif text-3xl text-ink tracking-tight">{{ __('Admin Dashboard') }}</h1>
            <p class="text-muted mt-1.5 text-sm">{{ __('Overview of your EcoLife Hub platform') }}</p>
        </div>

        {{-- Stats Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 animate-fade-up" style="animation-delay: 0.1s">
            <div class="card p-4 md:p-6 flex items-start gap-4">
                <div class="w-12 h-12 rounded-xl bg-forest-100 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 text-forest-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m-4.5-8.303a4 4 0 108 0 4 4 0 00-8 0z"/></svg>
                </div>
                <div>
                    <p class="stat-value">{{ $totalUsers }}</p>
                    <p class="stat-label mt-1">{{ __('Users') }}</p>
                </div>
            </div>

            <div class="card p-4 md:p-6 flex items-start gap-4">
                <div class="w-12 h-12 rounded-xl bg-gold-100 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                </div>
                <div class="flex-1">
                    <p class="stat-value">{{ $totalArticles }}</p>
                    <p class="stat-label mt-1">{{ __('Articles') }} <span class="text-muted/60 normal-case">({{ $publishedArticles }} {{ __('published') }})</span></p>
                </div>
            </div>

            <div class="card p-4 md:p-6 flex items-start gap-4">
                <div class="w-12 h-12 rounded-xl bg-forest-100 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 text-forest-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                </div>
                <div>
                    <p class="stat-value">{{ $todayActivities }}</p>
                    <p class="stat-label mt-1">{{ __("Today's Activities") }}</p>
                    <p class="text-xs text-muted/60 mt-0.5">{{ $activeToday }} {{ __('active') }}</p>
                </div>
            </div>

            <div class="card p-4 md:p-6 flex items-start gap-4">
                <div class="w-12 h-12 rounded-xl bg-gold-100 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
                </div>
                <div>
                    <p class="stat-value">{{ $totalQuizQuestions }}</p>
                    <p class="stat-label mt-1">{{ __('Quiz Questions') }}</p>
                </div>
            </div>

            <div class="card p-4 md:p-6 flex items-start gap-4">
                <div class="w-12 h-12 rounded-xl bg-forest-100 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 text-forest-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                </div>
                <div>
                    <p class="stat-value">{{ $totalComments }}</p>
                    <p class="stat-label mt-1">{{ __('Comments') }}</p>
                </div>
            </div>

            <div class="card p-4 md:p-6 flex items-start gap-4">
                <div class="w-12 h-12 rounded-xl bg-gold-100 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"/></svg>
                </div>
                <div>
                    <p class="stat-value">{{ $totalThreads }}</p>
                    <p class="stat-label mt-1">{{ __('Discussions') }}</p>
                </div>
            </div>
        </div>

        {{-- Recent Data --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 animate-fade-up" style="animation-delay: 0.2s">
            <div class="card overflow-hidden">
                <div class="px-6 py-4 border-b border-sage-100 flex items-center gap-2.5">
                    <svg class="w-5 h-5 text-forest-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m-4.5-8.303a4 4 0 108 0 4 4 0 00-8 0z"/></svg>
                    <h2 class="font-semibold text-forest-700 text-sm">{{ __('Latest Users') }}</h2>
                </div>
                <div class="divide-y divide-sage-100">
                    @forelse($latestUsers as $user)
                        <div class="px-6 py-3.5 flex items-center justify-between hover:bg-sage-50 transition-colors">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-forest-100 flex items-center justify-center text-sm font-semibold text-forest-700">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-forest-700">{{ $user->name }}</p>
                                    <p class="text-xs text-muted">{{ $user->email }}</p>
                                </div>
                            </div>
                            <span class="text-xs text-muted/60">{{ $user->created_at->diffForHumans() }}</span>
                        </div>
                    @empty
                        <p class="px-6 py-10 text-center text-muted text-sm">{{ __('No users yet.') }}</p>
                    @endforelse
                </div>
            </div>

            <div class="card overflow-hidden">
                <div class="px-6 py-4 border-b border-sage-100 flex items-center gap-2.5">
                    <svg class="w-5 h-5 text-forest-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                    <h2 class="font-semibold text-forest-700 text-sm">{{ __('Latest Articles') }}</h2>
                </div>
                <div class="divide-y divide-sage-100">
                    @forelse($latestArticles as $article)
                        <div class="px-6 py-3.5 flex items-center justify-between hover:bg-sage-50 transition-colors">
                            <div class="min-w-0">
                                <p class="text-sm font-medium text-forest-700 truncate max-w-xs">{{ $article->title }}</p>
                                <p class="text-xs text-muted mt-0.5">
                                    <span class="px-1.5 py-0.5 rounded text-[10px] font-medium border {{ $article->categoryColor() }}">{{ $article->categoryLabel() }}</span>
                                    <span class="mx-1.5 text-muted/40">&middot;</span>
                                    <span class="{{ $article->language === 'id' ? 'text-red-500' : 'text-blue-500' }} uppercase text-[10px] font-semibold">{{ $article->language }}</span>
                                </p>
                            </div>
                            <span class="text-xs text-muted/60 shrink-0 ml-3">{{ $article->published_at?->diffForHumans() }}</span>
                        </div>
                    @empty
                        <p class="px-6 py-10 text-center text-muted text-sm">{{ __('No articles yet.') }}</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
