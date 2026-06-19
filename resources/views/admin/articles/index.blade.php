@extends('admin.layouts.app')

@section('title', __('Articles'))
@section('breadcrumb', __('Articles'))

@section('content')
    <div class="space-y-6">
        <div class="flex items-center justify-between animate-fade-up">
            <div>
                <h1 class="font-serif text-3xl text-ink tracking-tight">{{ __('Articles') }}</h1>
                <p class="text-muted text-sm mt-1.5">{{ $totalPublished }}/{{ $totalAll }} {{ __('published') }}</p>
            </div>
            <a href="{{ route('admin.articles.create') }}" class="btn-primary">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                {{ __('New Article') }}
            </a>
        </div>

        {{-- Filters --}}
        <form method="GET" class="flex flex-wrap gap-3 items-end animate-fade-up" style="animation-delay: 0.05s">
            <div>
                <label class="text-xs font-medium text-muted block mb-1.5">{{ __('Search') }}</label>
                <div class="relative">
                    <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-muted/50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="{{ __('Title or excerpt...') }}" class="input-field text-sm pl-10 pr-3 py-2 w-60">
                </div>
            </div>
            <div>
                <label class="text-xs font-medium text-muted block mb-1.5">{{ __('Category') }}</label>
                <select name="category" class="input-field text-sm px-3 py-2" onchange="this.form.submit()">
                    <option value="">{{ __('All Categories') }}</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->category }}" {{ request('category') === $cat->category ? 'selected' : '' }}>
                            {{ (new \App\Models\Article())->setAttribute('category', $cat->category)->categoryLabel() }} ({{ $cat->total }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="text-xs font-medium text-muted block mb-1.5">{{ __('Language') }}</label>
                <select name="language" class="input-field text-sm px-3 py-2" onchange="this.form.submit()">
                    <option value="">{{ __('All') }}</option>
                    <option value="en" {{ request('language') === 'en' ? 'selected' : '' }}>English</option>
                    <option value="id" {{ request('language') === 'id' ? 'selected' : '' }}>Bahasa Indonesia</option>
                </select>
            </div>
            <button type="submit" class="px-4 py-2 bg-forest-600 text-cream rounded-xl text-sm font-medium hover:bg-forest-700 transition-all duration-200 shadow-sm">
                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                {{ __('Filter') }}
            </button>
            <a href="{{ route('admin.articles.index') }}" class="px-4 py-2 text-muted hover:text-ink text-sm font-medium transition-colors">&times; {{ __('Reset') }}</a>
        </form>

        {{-- Table --}}
        <div class="card overflow-hidden animate-fade-up" style="animation-delay: 0.1s">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-sage-50/80 text-muted text-left">
                            <th class="px-6 py-3.5 font-semibold text-xs uppercase tracking-wider">{{ __('Title') }}</th>
                            <th class="px-6 py-3.5 font-semibold text-xs uppercase tracking-wider">{{ __('Category') }}</th>
                            <th class="px-6 py-3.5 font-semibold text-xs uppercase tracking-wider">{{ __('Lang') }}</th>
                            <th class="px-6 py-3.5 font-semibold text-xs uppercase tracking-wider">{{ __('Status') }}</th>
                            <th class="px-6 py-3.5 font-semibold text-xs uppercase tracking-wider">{{ __('Date') }}</th>
                            <th class="px-6 py-3.5 font-semibold text-xs uppercase tracking-wider">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-sage-100">
                        @forelse ($articles as $article)
                            <tr class="hover:bg-sage-50/50 transition-colors">
                                <td class="px-6 py-4">
                                    <p class="font-medium text-forest-700 truncate max-w-xs">{{ $article->title }}</p>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border {{ $article->categoryColor() }}">
                                        {{ $article->categoryLabel() }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-0.5 rounded text-[10px] font-semibold uppercase tracking-wider {{ $article->language === 'id' ? 'bg-red-50 text-red-600' : 'bg-blue-50 text-blue-600' }}">
                                        {{ $article->language }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    @if ($article->is_published)
                                        <span class="flex items-center gap-1 text-green-600 font-medium text-xs">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                            {{ __('Published') }}
                                        </span>
                                    @else
                                        <span class="text-muted text-xs">{{ __('Draft') }}</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-muted text-xs">{{ $article->published_at?->diffForHumans() ?? '-' }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-1.5">
                                        <a href="{{ route('admin.articles.show', $article) }}"
                                           class="p-2 rounded-lg text-muted hover:text-forest-600 hover:bg-forest-50 transition-all duration-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        </a>
                                        <a href="{{ route('admin.articles.edit', $article) }}"
                                           class="p-2 rounded-lg text-muted hover:text-forest-600 hover:bg-forest-50 transition-all duration-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        </a>
                                        <form action="{{ route('admin.articles.destroy', $article) }}" method="POST" onsubmit="return confirm('{{ __('Delete this article?') }}')" class="inline">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                    class="p-2 rounded-lg text-muted hover:text-red-600 hover:bg-red-50 transition-all duration-200">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-muted text-sm">{{ __('No articles found.') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($articles->hasPages())
                <div class="px-6 py-4 border-t border-sage-100">
                    {{ $articles->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
