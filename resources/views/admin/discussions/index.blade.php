@extends('admin.layouts.app')

@section('title', __('Discussions'))
@section('breadcrumb', __('Discussions'))

@section('content')
    <div class="space-y-6">
        <div class="animate-fade-up">
            <h1 class="font-serif text-3xl text-ink tracking-tight">{{ __('Discussions') }}</h1>
            <p class="text-muted text-sm mt-1.5">{{ __('Manage community discussion threads') }}</p>
        </div>

        <div class="card overflow-hidden animate-fade-up" style="animation-delay: 0.1s">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-sage-50/80 text-muted text-left">
                            <th class="px-6 py-3.5 font-semibold text-xs uppercase tracking-wider">{{ __('Title') }}</th>
                            <th class="px-6 py-3.5 font-semibold text-xs uppercase tracking-wider">{{ __('Author') }}</th>
                            <th class="px-6 py-3.5 font-semibold text-xs uppercase tracking-wider">{{ __('Category') }}</th>
                            <th class="px-6 py-3.5 font-semibold text-xs uppercase tracking-wider">{{ __('Replies') }}</th>
                            <th class="px-6 py-3.5 font-semibold text-xs uppercase tracking-wider">{{ __('Status') }}</th>
                            <th class="px-6 py-3.5 font-semibold text-xs uppercase tracking-wider">{{ __('Date') }}</th>
                            <th class="px-6 py-3.5 font-semibold text-xs uppercase tracking-wider">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-sage-100">
                        @forelse ($threads as $thread)
                            <tr class="hover:bg-sage-50/50 transition-colors">
                                <td class="px-6 py-4">
                                    <p class="font-medium text-forest-700 truncate max-w-xs">{{ $thread->title }}</p>
                                </td>
                                <td class="px-6 py-4 text-sage-600 text-sm">{{ $thread->user->name }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-sage-100 text-sage-700">{{ $thread->category }}</span>
                                </td>
                                <td class="px-6 py-4 text-muted text-sm">{{ $thread->replies->count() }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex gap-1.5">
                                        @if ($thread->is_pinned)
                                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-semibold bg-amber-50 text-amber-700">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.05 4.363a1.5 1.5 0 012.121 0l2.122 2.121a1.5 1.5 0 010 2.121l-7.07 7.071a1.5 1.5 0 01-.707.394l-3.536.707a.5.5 0 01-.606-.606l.707-3.536a1.5 1.5 0 01.394-.707l7.07-7.07z"/></svg>
                                                {{ __('Pinned') }}
                                            </span>
                                        @endif
                                        @if ($thread->is_locked)
                                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-semibold bg-red-50 text-red-600">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                                                {{ __('Locked') }}
                                            </span>
                                        @endif
                                        @if (!$thread->is_pinned && !$thread->is_locked)
                                            <span class="text-muted/60 text-xs">{{ __('Active') }}</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-muted text-xs">{{ $thread->created_at->diffForHumans() }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-1.5">
                                        <form action="{{ route('admin.discussions.pin', $thread) }}" method="POST" class="inline">
                                            @csrf @method('PATCH')
                                            <button type="submit"
                                                    class="p-2 rounded-lg transition-all duration-200 {{ $thread->is_pinned ? 'text-amber-600 hover:bg-amber-50' : 'text-muted hover:text-amber-600 hover:bg-amber-50' }}">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.05 4.363a1.5 1.5 0 012.121 0l2.122 2.121a1.5 1.5 0 010 2.121l-7.07 7.071a1.5 1.5 0 01-.707.394l-3.536.707a.5.5 0 01-.606-.606l.707-3.536a1.5 1.5 0 01.394-.707l7.07-7.07z"/></svg>
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.discussions.lock', $thread) }}" method="POST" class="inline">
                                            @csrf @method('PATCH')
                                            <button type="submit"
                                                    class="p-2 rounded-lg transition-all duration-200 {{ $thread->is_locked ? 'text-red-600 hover:bg-red-50' : 'text-muted hover:text-red-600 hover:bg-red-50' }}">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                                            </button>
                                        </form>
                                        <a href="{{ route('discussions.show', $thread) }}" target="_blank"
                                           class="p-2 rounded-lg text-muted hover:text-forest-600 hover:bg-forest-50 transition-all duration-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        </a>
                                        <form action="{{ route('admin.discussions.destroy', $thread) }}" method="POST"
                                              onsubmit="return confirm('{{ __('Delete this thread?') }}')">
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
                                <td colspan="7" class="px-6 py-12 text-center text-muted text-sm">{{ __('No threads yet.') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($threads->hasPages())
                <div class="px-6 py-4 border-t border-sage-100">
                    {{ $threads->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
