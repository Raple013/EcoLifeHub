<div class="mt-12 pt-8 border-t border-sage-100">
    <h2 class="font-display text-2xl text-forest-800 mb-6">&#128172; {{ __('Comments') }} ({{ $article->comments->count() }})</h2>

    @auth
        <form action="{{ route('comments.store', $article) }}" method="POST" class="mb-8">
            @csrf
            <textarea name="body" rows="3" class="input-field" placeholder="{{ __('Write a comment...') }}" required maxlength="2000"></textarea>
            <x-input-error :messages="$errors->get('body')" />
            <button type="submit" class="btn-primary mt-3 px-6 py-2.5 text-sm">
                {{ __('Post Comment') }}
            </button>
        </form>
    @else
        <div class="bg-sage-50 rounded-2xl p-5 text-center mb-8">
            <p class="text-sage-500 text-sm">
                <a href="{{ route('login') }}" class="text-forest-600 hover:text-forest-700 font-semibold underline">{{ __('Login') }}</a>
                {{ __('to leave a comment.') }}
            </p>
        </div>
    @endauth

    <div class="space-y-4">
        @forelse ($article->comments as $comment)
            <div class="bg-white rounded-2xl border border-sage-200 p-5">
                <div class="flex items-start justify-between gap-3 mb-3">
                    <div class="flex items-center gap-3">
                        <x-user-avatar :user="$comment->user" class="w-9 h-9 text-sm" />
                        <div>
                            <p class="font-semibold text-forest-700 text-sm flex items-center gap-1.5">{{ $comment->user->name }} <x-achievement-tag :user="$comment->user" /></p>
                            <p class="text-xs text-sage-400">{{ $comment->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    @if (auth()->id() === $comment->user_id || auth()->user()?->hasRole('admin'))
                        <form action="{{ route('comments.destroy', $comment) }}" method="POST"
                              onsubmit="return confirm('{{ __('Delete this comment?') }}')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-xs text-red-500 hover:text-red-700 transition-colors font-medium">
                                {{ __('Delete') }}
                            </button>
                        </form>
                    @endif
                </div>
                <p class="text-sage-700 text-sm leading-relaxed">{{ $comment->body }}</p>
            </div>
        @empty
            <div class="text-center py-10">
                <p class="text-3xl mb-2">&#128172;</p>
                <p class="text-sm text-sage-400">{{ __('No comments yet. Be the first to comment!') }}</p>
            </div>
        @endforelse
    </div>
</div>
