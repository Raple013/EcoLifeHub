<x-app-layout>
    <div class="max-w-4xl mx-auto py-10 px-4 space-y-6">

        <a href="{{ route('discussions.index') }}"
           class="inline-flex items-center gap-1 text-sage-500 hover:text-forest-600 text-sm transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            {{ __('Back to Discussions') }}
        </a>

        {{-- Thread --}}
        <div class="card p-6 md:p-8">
            <div class="flex items-start gap-4 mb-5">
                <x-user-avatar :user="$thread->user" class="w-12 h-12 text-lg" />
                <div class="flex-1">
                    <div class="flex items-center gap-2 flex-wrap">
                        @if ($thread->is_pinned)
                            <span class="px-2 py-0.5 rounded text-xs font-semibold bg-amber-100 text-amber-700">&#128204; {{ __('Pinned') }}</span>
                        @endif
                        @if ($thread->is_locked)
                            <span class="px-2 py-0.5 rounded text-xs font-semibold bg-red-100 text-red-600">&#128274; {{ __('Locked') }}</span>
                        @endif
                    </div>
                    <h1 class="font-display text-2xl md:text-3xl text-forest-800 mt-1">{{ $thread->title }}</h1>
                    <div class="flex items-center gap-3 text-sm text-sage-400 mt-2">
                        <span class="flex items-center gap-1.5">{{ $thread->user->name }} <x-achievement-tag :user="$thread->user" /></span>
                        <span>&bull;</span>
                        <span>{{ $thread->created_at->diffForHumans() }}</span>
                    </div>
                </div>
                @if (auth()->id() === $thread->user_id || auth()->user()?->hasRole('admin'))
                    <form action="{{ route('discussions.destroy', $thread) }}" method="POST"
                          onsubmit="return confirm('{{ __('Delete this thread?') }}')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-xs text-red-500 hover:text-red-700 font-medium transition-colors">
                            {{ __('Delete') }}
                        </button>
                    </form>
                @endif
            </div>
            <div class="text-sage-700 leading-relaxed prose prose-sage max-w-none">
                {!! nl2br(e($thread->body)) !!}
            </div>
        </div>

        {{-- Replies --}}
        <div>
            <h2 class="font-display text-xl text-forest-800 mb-4">&#128172; {{ __('Replies') }} ({{ $thread->replies->count() }})</h2>

            <div class="space-y-4">
                @forelse ($thread->replies as $reply)
                    <div class="bg-white rounded-2xl border border-sage-200 p-5">
                        <div class="flex items-start justify-between gap-3 mb-3">
                            <div class="flex items-center gap-3">
                                <x-user-avatar :user="$reply->user" class="w-9 h-9 text-sm" />
                                <div>
                                    <p class="font-semibold text-forest-700 text-sm flex items-center gap-1.5">{{ $reply->user->name }} <x-achievement-tag :user="$reply->user" /></p>
                                    <p class="text-xs text-sage-400">{{ $reply->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            @if (auth()->id() === $reply->user_id || auth()->user()?->hasRole('admin'))
                                <form action="{{ route('replies.destroy', $reply) }}" method="POST"
                                      onsubmit="return confirm('{{ __('Delete this reply?') }}')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-xs text-red-500 hover:text-red-700 transition-colors font-medium">
                                        {{ __('Delete') }}
                                    </button>
                                </form>
                            @endif
                        </div>
                        <p class="text-sage-700 text-sm leading-relaxed">{{ $reply->body }}</p>
                    </div>
                @empty
                    <div class="text-center py-8">
                        <p class="text-sage-400 text-sm">{{ __('No replies yet.') }}</p>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- Reply form --}}
        @auth
            @if ($thread->is_locked)
                <div class="bg-red-50 border border-red-200 text-red-700 px-5 py-4 rounded-2xl text-sm font-medium">
                    &#128274; {{ __('This thread is locked. No new replies can be added.') }}
                </div>
            @else
                <div class="bg-white rounded-2xl border border-sage-200 p-6">
                    <h3 class="font-bold text-forest-700 mb-4">{{ __('Write a Reply') }}</h3>
                    <form action="{{ route('replies.store', $thread) }}" method="POST">
                        @csrf
                        <textarea name="body" rows="4" class="input-field" placeholder="{{ __('Write your reply...') }}" required maxlength="5000"></textarea>
                        <x-input-error :messages="$errors->get('body')" />
                        <button type="submit" class="btn-primary mt-3 px-6 py-2.5 text-sm">
                            &#128172; {{ __('Post Reply') }}
                        </button>
                    </form>
                </div>
            @endif
        @else
            <div class="bg-sage-50 rounded-2xl p-5 text-center">
                <p class="text-sage-500 text-sm">
                    <a href="{{ route('login') }}" class="text-forest-600 hover:text-forest-700 font-semibold underline">{{ __('Login') }}</a>
                    {{ __('to join the discussion.') }}
                </p>
            </div>
        @endauth
    </div>
</x-app-layout>
