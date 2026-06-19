@extends('admin.layouts.app')

@section('title', __('Comments'))
@section('breadcrumb', __('Comments'))

@section('content')
    <div class="space-y-6">
        <div class="animate-fade-up">
            <h1 class="font-serif text-3xl text-ink tracking-tight">{{ __('Comments') }}</h1>
            <p class="text-muted text-sm mt-1.5">{{ __('Manage article comments') }}</p>
        </div>

        <div class="card overflow-hidden animate-fade-up" style="animation-delay: 0.1s">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-sage-50/80 text-muted text-left">
                            <th class="px-6 py-3.5 font-semibold text-xs uppercase tracking-wider">{{ __('Comment') }}</th>
                            <th class="px-6 py-3.5 font-semibold text-xs uppercase tracking-wider">{{ __('User') }}</th>
                            <th class="px-6 py-3.5 font-semibold text-xs uppercase tracking-wider">{{ __('Article') }}</th>
                            <th class="px-6 py-3.5 font-semibold text-xs uppercase tracking-wider">{{ __('Date') }}</th>
                            <th class="px-6 py-3.5 font-semibold text-xs uppercase tracking-wider">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-sage-100">
                        @forelse ($comments as $comment)
                            <tr class="hover:bg-sage-50/50 transition-colors">
                                <td class="px-6 py-4 max-w-sm">
                                    <p class="text-sage-700 truncate">{{ $comment->body }}</p>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="font-medium text-forest-700">{{ $comment->user->name }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('articles.show', $comment->article) }}" target="_blank"
                                       class="text-forest-600 hover:text-forest-700 underline text-xs">
                                        {{ Str::limit($comment->article->title, 40) }}
                                    </a>
                                </td>
                                <td class="px-6 py-4 text-muted text-xs">{{ $comment->created_at->diffForHumans() }}</td>
                                <td class="px-6 py-4">
                                    <form action="{{ route('admin.comments.destroy', $comment) }}" method="POST"
                                          onsubmit="return confirm('{{ __('Delete this comment?') }}')">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                                class="p-2 rounded-lg text-muted hover:text-red-600 hover:bg-red-50 transition-all duration-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-muted text-sm">{{ __('No comments yet.') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($comments->hasPages())
                <div class="px-6 py-4 border-t border-sage-100">
                    {{ $comments->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
