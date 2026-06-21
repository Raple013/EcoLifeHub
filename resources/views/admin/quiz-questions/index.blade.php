@extends('admin.layouts.app')

@section('title', __('Quiz Questions'))
@section('breadcrumb', __('Quiz Questions'))

@section('content')
    <div class="space-y-6">
        <div class="flex items-center justify-between animate-fade-up">
            <div>
                <h1 class="font-serif text-3xl text-ink tracking-tight">{{ __('Quiz Questions') }}</h1>
                <p class="text-muted text-sm mt-1.5">{{ $totalAll }} {{ __('total questions') }}</p>
            </div>
            <a href="{{ route('admin.quiz-questions.create') }}" class="btn-primary">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                {{ __('New Question') }}
            </a>
        </div>

        <div class="card overflow-hidden animate-fade-up" style="animation-delay: 0.1s">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-sage-50/80 text-muted text-left">
                            <th class="px-6 py-3.5 font-semibold text-xs uppercase tracking-wider">{{ __('Question') }}</th>
                                <th class="px-6 py-3.5 font-semibold text-xs uppercase tracking-wider">{{ __('Options') }}</th>
                                <th class="px-6 py-3.5 font-semibold text-xs uppercase tracking-wider">{{ __('Correct Answer') }}</th>
                                <th class="px-6 py-3.5 font-semibold text-xs uppercase tracking-wider">{{ __('Explanation') }}</th>
                                <th class="px-6 py-3.5 font-semibold text-xs uppercase tracking-wider">{{ __('Date') }}</th>
                                <th class="px-6 py-3.5 font-semibold text-xs uppercase tracking-wider">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-sage-100">
                        @forelse ($questions as $q)
                            <tr class="hover:bg-sage-50/50 transition-colors">
                                <td class="px-6 py-4 max-w-sm">
                                    <p class="font-medium text-forest-700 truncate">{{ $q->question }}</p>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-wrap gap-1.5 max-w-xs">
                                        @foreach ($q->options as $opt)
                                            <span class="px-2 py-0.5 rounded text-xs {{ $opt === $q->answer ? 'bg-green-50 text-green-700 font-medium' : 'bg-sage-100 text-sage-600' }}">
                                                {{ Str::limit($opt, 25) }}
                                            </span>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-green-50 text-green-700">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                            {{ $q->answer }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 max-w-xs">
                                        @if ($q->explanation)
                                            <p class="text-xs text-muted truncate">{{ $q->explanation }}</p>
                                        @else
                                            <span class="text-xs text-muted/50">{{ __('None') }}</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-muted text-xs">{{ $q->created_at->diffForHumans() }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-1.5">
                                        <a href="{{ route('admin.quiz-questions.edit', $q) }}"
                                           class="p-2 rounded-lg text-muted hover:text-forest-600 hover:bg-forest-50 transition-all duration-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        </a>
                                        <form action="{{ route('admin.quiz-questions.destroy', $q) }}" method="POST"
                                              onsubmit="return confirm('{{ __('Delete this question?') }}')">
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
                                <td colspan="6" class="px-6 py-12 text-center text-muted text-sm">{{ __('No quiz questions yet.') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($questions->hasPages())
                <div class="px-6 py-4 border-t border-sage-100">
                    {{ $questions->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
