@extends('admin.layouts.app')

@section('title', $article->title)
@section('breadcrumb', $article->title)

@section('content')
    <div class="max-w-4xl mx-auto space-y-6">
        <a href="{{ route('admin.articles.index') }}" class="inline-flex items-center gap-1.5 text-muted hover:text-forest-600 text-sm font-medium transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            {{ __('Back to Articles') }}
        </a>

        <div class="card overflow-hidden">
            @if ($article->image_url)
                <img src="{{ Storage::url($article->image_url) }}" class="w-full h-72 object-cover">
            @endif
            <div class="p-8 space-y-6">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <h1 class="font-serif text-3xl text-ink tracking-tight">{{ $article->title }}</h1>
                        <div class="flex items-center gap-3 mt-3 text-sm text-muted">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border {{ $article->categoryColor() }}">
                                {{ $article->categoryLabel() }}
                            </span>
                            <span class="px-2 py-0.5 rounded text-[10px] font-semibold uppercase tracking-wider {{ $article->language === 'id' ? 'bg-red-50 text-red-600' : 'bg-blue-50 text-blue-600' }}">
                                {{ $article->language }}
                            </span>
                            @if ($article->is_published)
                                <span class="flex items-center gap-1 text-green-600 font-medium">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    {{ __('Published') }}
                                </span>
                            @else
                                <span class="text-muted">{{ __('Draft') }}</span>
                            @endif
                            <span class="text-muted/60">{{ $article->published_at?->diffForHumans() ?? '-' }}</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 shrink-0">
                        <a href="{{ route('admin.articles.edit', $article) }}" class="btn-primary text-sm px-4 py-2.5">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            {{ __('Edit') }}
                        </a>
                        <form action="{{ route('admin.articles.destroy', $article) }}" method="POST" onsubmit="return confirm('{{ __('Delete this article?') }}')">
                            @csrf @method('DELETE')
                            <button type="submit" class="px-4 py-2.5 rounded-xl text-sm font-medium bg-red-50 text-red-600 hover:bg-red-100 transition-all duration-200">
                                <svg class="w-4 h-4 mr-1.5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                {{ __('Delete') }}
                            </button>
                        </form>
                    </div>
                </div>

                @if ($article->excerpt)
                    <div class="bg-sage-50 rounded-xl p-5 text-muted italic border-l-4 border-forest-200 text-sm leading-relaxed">
                        {{ $article->excerpt }}
                    </div>
                @endif

                <div class="prose prose-sage max-w-none leading-relaxed text-ink/80">
                    {!! $article->content !!}
                </div>

                <div class="flex items-center gap-6 pt-5 border-t border-sage-100 text-sm text-muted">
                    @if ($article->author)
                        <span>{{ __('By') }} <strong class="text-forest-700 font-semibold">{{ $article->author }}</strong></span>
                    @endif
                    @if ($article->source_url)
                        <a href="{{ $article->source_url }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1 text-blue-600 hover:underline">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            {{ __('Source') }}
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
