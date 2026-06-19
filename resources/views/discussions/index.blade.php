<x-app-layout>
    <div class="max-w-6xl mx-auto py-10 px-4 space-y-8">

        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-forest-100 text-forest-700 mb-4">
                    &#128172; {{ __('Community') }}
                </span>
                <h1 class="font-display text-4xl md:text-5xl text-forest-800">{{ __('Discussions') }}</h1>
                <p class="text-sage-500 mt-2">{{ __('Share and discuss with the community') }}</p>
            </div>
            <a href="{{ route('discussions.create') }}" class="btn-primary text-base py-4 px-8 shrink-0">
                + {{ __('New Thread') }}
            </a>
        </div>

        {{-- Category filter --}}
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('discussions.index') }}"
               class="px-4 py-2 rounded-xl text-sm font-medium transition-colors
               {{ !request('category') ? 'bg-forest-600 text-white' : 'bg-sage-100 text-sage-700 hover:bg-sage-200' }}">
                {{ __('All') }}
            </a>
            @php
                $catLabels = [
                    'general' => __('General'),
                    'nutrition' => __('Nutrition'),
                    'sdg' => 'SDG',
                    'health' => __('Health'),
                    'tips' => __('Tips & Tricks'),
                    'lainnya' => __('Other'),
                ];
            @endphp
            @foreach ($catLabels as $key => $label)
                <a href="{{ route('discussions.index', ['category' => $key]) }}"
                   class="px-4 py-2 rounded-xl text-sm font-medium transition-colors
                   {{ request('category') === $key ? 'bg-forest-600 text-white' : 'bg-sage-100 text-sage-700 hover:bg-sage-200' }}">
                    {{ $label }}
                </a>
            @endforeach
        </div>

        {{-- Search --}}
        <form method="GET" class="flex gap-3 items-end">
            @if (request('category'))
                <input type="hidden" name="category" value="{{ request('category') }}">
            @endif
            <div class="flex-1">
                <input type="text" name="search" value="{{ request('search') }}"
                       class="input-field" placeholder="{{ __('Search discussions...') }}">
            </div>
            <button type="submit" class="px-5 py-2.5 bg-forest-600 text-white rounded-xl text-sm font-medium hover:bg-forest-700 transition-colors">
                &#128269; {{ __('Search') }}
            </button>
            @if (request('search'))
                <a href="{{ route('discussions.index', ['category' => request('category')]) }}"
                   class="px-4 py-2.5 text-sage-500 hover:text-sage-700 text-sm font-medium transition-colors">
                    &times; {{ __('Reset') }}
                </a>
            @endif
        </form>

        {{-- Thread list --}}
        <div class="space-y-3">
            @forelse ($threads as $thread)
                <a href="{{ route('discussions.show', $thread) }}" class="block card p-5 hover:ring-2 hover:ring-forest-300 transition-all">
                    <div class="flex items-start gap-4">
                        <x-user-avatar :user="$thread->user" class="w-10 h-10 text-sm" />
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2 flex-wrap">
                                @if ($thread->is_pinned)
                                    <span class="px-2 py-0.5 rounded text-xs font-semibold bg-amber-100 text-amber-700">&#128204; {{ __('Pinned') }}</span>
                                @endif
                                @if ($thread->is_locked)
                                    <span class="px-2 py-0.5 rounded text-xs font-semibold bg-red-100 text-red-600">&#128274; {{ __('Locked') }}</span>
                                @endif
                                <span class="px-2 py-0.5 rounded text-xs font-semibold bg-sage-100 text-sage-600">{{ $catLabels[$thread->category] ?? $thread->category }}</span>
                            </div>
                            <h3 class="font-bold text-forest-700 mt-1">{{ $thread->title }}</h3>
                            <p class="text-sage-500 text-sm mt-1 line-clamp-1">{{ Str::limit(strip_tags($thread->body), 150) }}</p>
                            <div class="flex items-center gap-4 mt-3 text-xs text-sage-400">
                                <span class="flex items-center gap-1.5">{{ $thread->user->name }} <x-achievement-tag :user="$thread->user" /></span>
                                <span>&bull;</span>
                                <span>{{ $thread->created_at->diffForHumans() }}</span>
                                <span>&bull;</span>
                                <span>{{ $thread->replies->count() }} {{ __('replies') }}</span>
                            </div>
                        </div>
                    </div>
                </a>
            @empty
                <div class="card p-12 text-center">
                    <p class="text-5xl mb-4">&#128172;</p>
                    <h3 class="font-display text-2xl text-forest-800 mb-2">{{ __('No threads yet') }}</h3>
                    <p class="text-sage-500">{{ __('Be the first to start a discussion!') }}</p>
                    <a href="{{ route('discussions.create') }}" class="btn-primary mt-6">
                        + {{ __('New Thread') }}
                    </a>
                </div>
            @endforelse
        </div>

        @if ($threads->hasPages())
            <div>{{ $threads->appends(request()->query())->links() }}</div>
        @endif
    </div>
</x-app-layout>
