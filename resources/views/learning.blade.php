<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 px-4 space-y-8">

        {{-- Hero --}}
        <div class="text-center">
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-forest-100 text-forest-700 mb-4">
                &#128218; {{ __('Health & Wellness') }}
            </span>
            <h1 class="font-display text-4xl md:text-5xl text-forest-800">{{ __('Learn for a Healthier Life') }}</h1>
            <p class="text-sage-500 mt-2 max-w-2xl mx-auto">{{ __('Tips, guides, and insights on nutrition, disease prevention, mental health, fitness, and environmental wellness.') }}</p>
        </div>

        {{-- Language Tabs --}}
        <div class="flex flex-wrap gap-2 justify-center">
            <a href="{{ route('learning', ['lang' => 'en', 'category' => $category]) }}"
                class="px-4 py-2 rounded-xl text-sm font-medium transition-colors
                {{ $lang === 'en' ? 'bg-forest-600 text-white' : 'bg-sage-100 text-sage-700 hover:bg-sage-200' }}">
                {{ __('International') }}
            </a>
            <a href="{{ route('learning', ['lang' => 'id', 'category' => $category]) }}"
                class="px-4 py-2 rounded-xl text-sm font-medium transition-colors
                {{ $lang === 'id' ? 'bg-forest-600 text-white' : 'bg-sage-100 text-sage-700 hover:bg-sage-200' }}">
                {{ __('Nasional') }}
            </a>
        </div>

        {{-- Category Filter --}}
        <div class="flex flex-wrap gap-2 justify-center">
            <a href="{{ route('learning', ['lang' => $lang]) }}"
                class="px-4 py-2 rounded-xl text-sm font-medium transition-colors
                {{ !$category ? 'bg-forest-600 text-white' : 'bg-sage-100 text-sage-700 hover:bg-sage-200' }}">
                &#128196; {{ __('All') }}
            </a>
            @foreach ($categories as $cat)
                <a href="{{ route('learning', ['lang' => $lang, 'category' => $cat->category]) }}"
                    class="px-4 py-2 rounded-xl text-sm font-medium transition-colors
                    {{ $category === $cat->category ? 'bg-forest-600 text-white' : 'bg-sage-100 text-sage-700 hover:bg-sage-200' }}">
                    {!! (new \App\Models\Article())->setAttribute('category', $cat->category)->categoryIcon() !!}
                    {{ (new \App\Models\Article())->setAttribute('category', $cat->category)->categoryLabel() }}
                    <span class="text-xs opacity-60">({{ $cat->total }})</span>
                </a>
            @endforeach
        </div>

        {{-- Featured Article --}}
        @if ($featured && !$category)
                    <a href="{{ route('articles.show', $featured) }}" class="block card-interactive overflow-hidden">
                <div class="md:flex">
                    <div class="md:w-2/5 h-48 md:h-auto overflow-hidden flex items-center justify-center text-6xl {{ $featured->image_url ? '' : 'bg-gradient-to-br from-forest-400 to-emerald-600' }}">
                        @if ($featured->image_url)
                            <img src="{{ Storage::url($featured->image_url) }}" class="w-full h-full object-cover">
                        @else
                            {!! $featured->categoryIcon() !!}
                        @endif
                    </div>
                    <div class="p-8 md:w-3/5">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border {{ $featured->categoryColor() }}">
                            {!! $featured->categoryIcon() !!} {{ $featured->categoryLabel() }}
                        </span>
                        <h2 class="font-display text-2xl text-forest-800 mt-3 mb-2">{{ $featured->title }}</h2>
                        <p class="text-sage-500 text-sm">{{ $featured->excerptPreview(30) }}</p>
                        <div class="flex items-center gap-4 mt-4 text-xs text-sage-400">
                            <span>{{ $featured->readingTime() }}</span>
                            <span>&bull;</span>
                            <span>{{ $featured->published_at?->diffForHumans() }}</span>
                            @if ($featured->author)
                                <span>&bull;</span>
                                <span>{{ $featured->author }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </a>
        @endif

        {{-- Article Grid --}}
        @if ($articles->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($articles as $article)
                    <a href="{{ route('articles.show', $article) }}" class="card-interactive flex flex-col group">
                        <div class="h-40 overflow-hidden flex items-center justify-center text-5xl {{ $article->image_url ? '' : 'bg-gradient-to-br from-sage-300 to-forest-300' }}">
                            @if ($article->image_url)
                                <img src="{{ Storage::url($article->image_url) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            @else
                                {!! $article->categoryIcon() !!}
                            @endif
                        </div>
                        <div class="p-5 flex flex-col flex-1">
                            <span class="inline-flex self-start items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-medium border {{ $article->categoryColor() }}">
                                {{ $article->categoryLabel() }}
                                <span class="px-1.5 py-0.5 rounded text-[10px] font-semibold uppercase {{ $article->language === 'id' ? 'bg-red-100 text-red-600' : 'bg-blue-100 text-blue-600' }}">
                                    {{ $article->language }}
                                </span>
                            </span>
                            <h3 class="font-bold text-forest-700 mt-2 mb-1 group-hover:text-forest-500 transition-colors line-clamp-2">{{ $article->title }}</h3>
                            <p class="text-xs text-sage-500 flex-1 line-clamp-2">{{ $article->excerptPreview(15) }}</p>
                            <div class="flex items-center gap-3 mt-3 text-xs text-sage-400">
                                <span>{{ $article->readingTime() }}</span>
                                <span>&bull;</span>
                                <span>{{ $article->published_at?->diffForHumans() }}</span>
                            </div>
                            @if ($article->author)
                                <div class="mt-2 text-xs text-sage-400">
                                    &#128279; {{ $article->author }}
                                </div>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="mt-8">
                {{ $articles->appends(['lang' => $lang])->links() }}
            </div>
        @else
            <div class="text-center py-16">
                <span class="text-5xl block mb-4">&#128214;</span>
                <h3 class="font-display text-xl text-forest-800 mb-1">{{ __('No articles yet') }}</h3>
                <p class="text-sage-500 text-sm">{{ __('Check back soon for new health articles.') }}</p>
            </div>
        @endif
    </div>
</x-app-layout>
