<x-app-layout>
    <div class="max-w-4xl mx-auto py-10 px-4">

        <a href="{{ route('learning', ['lang' => $article->language]) }}" class="inline-flex items-center gap-1 text-sage-500 hover:text-forest-600 text-sm mb-8 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            {{ __('Back to Articles') }}
        </a>

        @if ($article->image_url)
            <img src="{{ Storage::url($article->image_url) }}" class="w-full h-64 md:h-80 object-cover rounded-2xl mb-8 border border-sage-200">
        @endif

        <article>
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium border {{ $article->categoryColor() }}">
                {!! $article->categoryIcon() !!} {{ $article->categoryLabel() }}
            </span>

            <h1 class="font-display text-3xl md:text-4xl text-forest-800 mt-4 mb-3 leading-tight">{{ $article->title }}</h1>

            <div class="flex items-center gap-4 text-sm text-sage-400 mb-8">
                <span>{{ $article->readingTime() }}</span>
                <span>&bull;</span>
                <span>{{ $article->published_at?->diffForHumans() }}</span>
                @if ($article->author)
                    <span>&bull;</span>
                    <span>{{ __('By') }} {{ $article->author }}</span>
                @endif
            </div>

            <div class="text-sage-700 leading-relaxed prose prose-sage max-w-none">
                {!! $article->content !!}
            </div>

            @if ($article->source_url)
                <div class="mt-8 pt-6 border-t border-sage-100">
                    <p class="text-xs text-sage-400">
                        &#128279; {{ __('Source') }}:
                        <a href="{{ $article->source_url }}" target="_blank" rel="noopener noreferrer" class="text-forest-600 hover:text-forest-700 underline">
                            {{ $article->author ?? $article->source_url }}
                        </a>
                        <span class="mx-1">&bull;</span>
                        <span class="text-sage-400">{{ $article->languageLabel() }}</span>
                    </p>
                </div>
            @elseif ($article->author)
                <div class="mt-8 pt-6 border-t border-sage-100">
                    <p class="text-xs text-sage-400">
                        &#9997; {{ __('By') }} {{ $article->author }}
                        <span class="mx-1">&bull;</span>
                        <span class="text-sage-400">{{ $article->languageLabel() }}</span>
                    </p>
                </div>
            @endif
        </article>

        {{-- Comments --}}
        @include('articles.comments')

        {{-- Related Articles --}}
        @if ($related->count() > 0)
            <div class="mt-12 pt-8 border-t border-sage-100">
                <h2 class="font-display text-2xl text-forest-800 mb-6">&#128200; {{ __('Related Articles') }}</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                    @foreach ($related as $rel)
                        <a href="{{ route('articles.show', $rel) }}" class="card-interactive p-5">
                            <span class="text-2xl block mb-2">{!! $rel->categoryIcon() !!}</span>
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium border {{ $rel->categoryColor() }}">
                                {{ $rel->categoryLabel() }}
                            </span>
                            <h3 class="font-bold text-forest-700 text-sm mt-2 line-clamp-2">{{ $rel->title }}</h3>
                            <p class="text-xs text-sage-400 mt-1">{{ $rel->readingTime() }}</p>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
