@extends('admin.layouts.app')

@section('title', __('Users'))
@section('breadcrumb', __('Users'))

@section('content')
    <div class="space-y-6">
        <div class="animate-fade-up">
            <h1 class="font-serif text-3xl text-ink tracking-tight">{{ __('Users') }}</h1>
            <p class="text-muted text-sm mt-1.5">{{ $totalUsers }} {{ __('total users') }}</p>
        </div>

        <form method="GET" class="flex flex-wrap gap-3 items-end animate-fade-up" style="animation-delay: 0.05s">
            <div>
                <label class="text-xs font-medium text-muted block mb-1.5">{{ __('Search') }}</label>
                <div class="relative">
                    <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-muted/50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="{{ __('Name or email...') }}" class="input-field text-sm pl-10 pr-3 py-2 w-60">
                </div>
            </div>
            <button type="submit" class="px-4 py-2 bg-forest-600 text-cream rounded-xl text-sm font-medium hover:bg-forest-700 transition-all duration-200 shadow-sm">
                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                {{ __('Search') }}
            </button>
            <a href="{{ route('admin.users.index') }}" class="px-4 py-2 text-muted hover:text-ink text-sm font-medium transition-colors">&times; {{ __('Reset') }}</a>
        </form>

        <div class="card overflow-hidden animate-fade-up" style="animation-delay: 0.1s">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-sage-50/80 text-muted text-left">
                            <th class="px-6 py-3.5 font-semibold text-xs uppercase tracking-wider">{{ __('Name') }}</th>
                            <th class="px-6 py-3.5 font-semibold text-xs uppercase tracking-wider">{{ __('Email') }}</th>
                            <th class="px-6 py-3.5 font-semibold text-xs uppercase tracking-wider">{{ __('Role') }}</th>
                            <th class="px-6 py-3.5 font-semibold text-xs uppercase tracking-wider">{{ __('Joined') }}</th>
                            <th class="px-6 py-3.5 font-semibold text-xs uppercase tracking-wider">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-sage-100">
                        @forelse ($users as $user)
                            <tr class="hover:bg-sage-50/50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-forest-100 flex items-center justify-center text-sm font-semibold text-forest-700">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                        <span class="font-medium text-forest-700">{{ $user->name }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sage-600">{{ $user->email }}</td>
                                <td class="px-6 py-4">
                                    @if ($user->hasRole('admin'))
                                        <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-forest-100 text-forest-700">{{ __('Admin') }}</span>
                                    @else
                                        <span class="text-muted/60 text-xs">{{ __('User') }}</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-muted text-xs">{{ $user->created_at->diffForHumans() }}</td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('admin.users.show', $user) }}"
                                       class="p-2 rounded-lg text-muted hover:text-forest-600 hover:bg-forest-50 transition-all duration-200 inline-block">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-muted text-sm">{{ __('No users found.') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($users->hasPages())
                <div class="px-6 py-4 border-t border-sage-100">
                    {{ $users->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
