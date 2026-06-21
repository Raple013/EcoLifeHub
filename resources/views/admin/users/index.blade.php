@extends('admin.layouts.app')

@section('title', __('Users'))
@section('breadcrumb', __('Users'))

@php
    $avatarColors = [
        ['bg' => 'bg-forest-100', 'text' => 'text-forest-700'],
        ['bg' => 'bg-gold-100', 'text' => 'text-gold-700'],
        ['bg' => 'bg-sage-200', 'text' => 'text-sage-700'],
        ['bg' => 'bg-rose-100', 'text' => 'text-rose-700'],
        ['bg' => 'bg-sky-100', 'text' => 'text-sky-700'],
        ['bg' => 'bg-amber-100', 'text' => 'text-amber-700'],
        ['bg' => 'bg-emerald-100', 'text' => 'text-emerald-700'],
        ['bg' => 'bg-indigo-100', 'text' => 'text-indigo-700'],
    ];
    function avatarColor($name, $colors) {
        $index = crc32($name) % count($colors);
        return $colors[abs($index)];
    }
@endphp

@section('content')
    <div class="space-y-8">
        {{-- Header --}}
        <div class="animate-fade-up flex items-end justify-between">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <span class="w-8 h-0.5 rounded-full bg-gold-400 inline-block"></span>
                    <span class="text-xs font-semibold uppercase tracking-[0.15em] text-sage-500">{{ __('User Management') }}</span>
                </div>
                <h1 class="font-serif text-3xl md:text-4xl text-ink tracking-tight leading-tight">{{ __('Users') }}</h1>
            </div>
            <p class="text-muted text-sm hidden sm:block">{{ $totalUsers }} {{ __('registered') }}</p>
        </div>

        {{-- Stat Cards --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 animate-fade-up" style="animation-delay: 0.05s">
            <div class="bg-white rounded-2xl p-5 shadow-[0_2px_12px_-4px_rgba(40,60,40,0.08)] border border-sage-100 hover:border-forest-200 transition-all duration-300 group">
                <div class="flex items-center justify-between">
                    <p class="text-2xl md:text-3xl font-serif font-bold text-ink tracking-tight">{{ $totalUsers }}</p>
                    <div class="w-10 h-10 rounded-xl bg-forest-50 flex items-center justify-center group-hover:bg-forest-100 transition-colors">
                        <svg class="w-5 h-5 text-forest-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m-4.5-8.303a4 4 0 108 0 4 4 0 00-8 0z"/></svg>
                    </div>
                </div>
                <p class="text-xs font-medium text-sage-500 mt-2 uppercase tracking-wide">{{ __('Total Users') }}</p>
            </div>
            <div class="bg-white rounded-2xl p-5 shadow-[0_2px_12px_-4px_rgba(40,60,40,0.08)] border border-sage-100 hover:border-emerald-200 transition-all duration-300 group">
                <div class="flex items-center justify-between">
                    <p class="text-2xl md:text-3xl font-serif font-bold text-ink tracking-tight">{{ $activeUsers }}</p>
                    <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center group-hover:bg-emerald-100 transition-colors">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                </div>
                <p class="text-xs font-medium text-sage-500 mt-2 uppercase tracking-wide">{{ __('Active') }}</p>
            </div>
            <div class="bg-white rounded-2xl p-5 shadow-[0_2px_12px_-4px_rgba(40,60,40,0.08)] border border-sage-100 hover:border-red-200 transition-all duration-300 group">
                <div class="flex items-center justify-between">
                    <p class="text-2xl md:text-3xl font-serif font-bold text-ink tracking-tight">{{ $blockedUsers }}</p>
                    <div class="w-10 h-10 rounded-xl bg-red-50 flex items-center justify-center group-hover:bg-red-100 transition-colors">
                        <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636"/></svg>
                    </div>
                </div>
                <p class="text-xs font-medium text-sage-500 mt-2 uppercase tracking-wide">{{ __('Blocked') }}</p>
            </div>
            <div class="bg-white rounded-2xl p-5 shadow-[0_2px_12px_-4px_rgba(40,60,40,0.08)] border border-sage-100 hover:border-amber-200 transition-all duration-300 group">
                <div class="flex items-center justify-between">
                    <p class="text-2xl md:text-3xl font-serif font-bold text-ink tracking-tight">{{ $adminUsers }}</p>
                    <div class="w-10 h-10 rounded-xl bg-amber-50 flex items-center justify-center group-hover:bg-amber-100 transition-colors">
                        <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
                    </div>
                </div>
                <p class="text-xs font-medium text-sage-500 mt-2 uppercase tracking-wide">{{ __('Admins') }}</p>
            </div>
        </div>

        {{-- Search + Table Card --}}
        <div class="animate-fade-up" style="animation-delay: 0.1s">
            <div class="bg-white rounded-2xl shadow-[0_2px_16px_-6px_rgba(40,60,40,0.1)] border border-sage-100 overflow-hidden">
                {{-- Search Bar --}}
                <div class="px-6 py-4 border-b border-sage-100">
                    <form method="GET" class="flex flex-wrap items-center gap-3">
                        <div class="relative flex-1 min-w-[200px]">
                            <svg class="w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-sage-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="{{ __('Search by name or email...') }}" class="w-full pl-10 pr-4 py-2.5 text-sm bg-sage-50/60 border border-sage-200 rounded-xl text-ink placeholder:text-sage-400 focus:outline-none focus:ring-2 focus:ring-forest-300 focus:border-forest-300 transition-all duration-200">
                        </div>
                        <button type="submit" class="px-5 py-2.5 bg-forest-600 text-cream rounded-xl text-sm font-semibold hover:bg-forest-700 transition-all duration-200 shadow-sm active:scale-[0.97]">
                            {{ __('Search') }}
                        </button>
                        @if (request('search'))
                            <a href="{{ route('admin.users.index') }}" class="px-4 py-2.5 text-sage-500 hover:text-ink text-sm font-medium transition-colors rounded-xl hover:bg-sage-50">{{ __('Clear') }}</a>
                        @endif
                    </form>
                </div>

                {{-- Table --}}
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-sage-50/60 text-sage-500 text-left">
                                <th class="px-6 py-4 font-semibold text-xs uppercase tracking-wider">{{ __('User') }}</th>
                                <th class="px-6 py-4 font-semibold text-xs uppercase tracking-wider">{{ __('Email') }}</th>
                                <th class="px-6 py-4 font-semibold text-xs uppercase tracking-wider">{{ __('Role') }}</th>
                                <th class="px-6 py-4 font-semibold text-xs uppercase tracking-wider">{{ __('Status') }}</th>
                                <th class="px-6 py-4 font-semibold text-xs uppercase tracking-wider">{{ __('Joined') }}</th>
                                <th class="px-6 py-4 font-semibold text-xs uppercase tracking-wider">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-sage-100">
                            @forelse ($users as $user)
                                @php $ac = avatarColor($user->name, $avatarColors); @endphp
                                <tr class="group hover:bg-sage-50/40 transition-all duration-200 relative">
                                    {{-- Left accent stripe --}}
                                    <td class="px-6 py-4 relative">
                                        <div class="absolute left-0 top-2 bottom-2 w-0.5 rounded-full bg-transparent group-hover:bg-forest-400 transition-all duration-300"></div>
                                        <div class="flex items-center gap-3.5">
                                            <div class="w-9 h-9 rounded-xl {{ $ac['bg'] }} flex items-center justify-center text-sm font-bold {{ $ac['text'] }} shadow-sm">
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </div>
                                            <span class="font-semibold text-forest-700 group-hover:text-forest-800 transition-colors">{{ $user->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sage-500 group-hover:text-sage-600 transition-colors">{{ $user->email }}</td>
                                    <td class="px-6 py-4">
                                        @if ($user->hasRole('admin'))
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-200">
                                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                                {{ __('Admin') }}
                                            </span>
                                        @else
                                            <span class="text-sage-400 text-xs font-medium">{{ __('User') }}</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($user->isBlocked())
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg text-xs font-semibold bg-red-50 text-red-600 border border-red-200">
                                                <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                                {{ __('Blocked') }}
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg text-xs font-semibold bg-emerald-50 text-emerald-600 border border-emerald-200">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                                {{ __('Active') }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-sage-400 text-xs whitespace-nowrap">{{ $user->created_at->diffForHumans() }}</td>
                                    <td class="px-6 py-4 relative">
                                        <div class="flex items-center gap-1">
                                            <a href="{{ route('admin.users.show', $user) }}"
                                               class="p-2 rounded-lg text-sage-400 hover:text-forest-600 hover:bg-forest-50 transition-all duration-200"
                                               title="{{ __('View') }}">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                            </a>
                                            @if ($user->isBlocked())
                                                <form action="{{ route('admin.users.unblock', $user) }}" method="POST" class="inline">
                                                    @csrf
                                                    <button type="submit"
                                                       class="p-2 rounded-lg text-emerald-400 hover:text-emerald-600 hover:bg-emerald-50 transition-all duration-200"
                                                       title="{{ __('Unblock') }}">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                    </button>
                                                </form>
                                            @else
                                                <button type="button"
                                                   onclick="document.getElementById('bf-{{ $user->id }}').classList.toggle('hidden')"
                                                   class="p-2 rounded-lg text-sage-400 hover:text-red-500 hover:bg-red-50 transition-all duration-200"
                                                   title="{{ __('Block') }}">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636"/></svg>
                                                </button>
                                                <form id="bf-{{ $user->id }}" action="{{ route('admin.users.block', $user) }}" method="POST" class="hidden absolute mt-1 right-0 bg-white border border-sage-200 rounded-xl p-3.5 shadow-lg z-10 min-w-[200px]">
                                                    @csrf
                                                    <p class="text-xs text-sage-500 mb-2.5">{{ __('Block this user?') }}</p>
                                                    <div class="flex gap-2">
                                                        <button type="submit" class="flex-1 px-3 py-1.5 bg-red-500 text-white rounded-lg text-xs font-semibold hover:bg-red-600 transition-colors">{{ __('Block') }}</button>
                                                        <button type="button" onclick="this.closest('form').classList.add('hidden')" class="px-3 py-1.5 text-sage-500 hover:text-ink text-xs font-medium transition-colors">{{ __('Cancel') }}</button>
                                                    </div>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-16 text-center">
                                        <div class="flex flex-col items-center gap-3">
                                            <div class="w-14 h-14 rounded-2xl bg-sage-100 flex items-center justify-center">
                                                <svg class="w-7 h-7 text-sage-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m-4.5-8.303a4 4 0 108 0 4 4 0 00-8 0z"/></svg>
                                            </div>
                                            <p class="text-sage-500 text-sm font-medium">{{ __('No users found.') }}</p>
                                            @if (request('search'))
                                                <a href="{{ route('admin.users.index') }}" class="text-forest-600 text-sm font-medium hover:underline">{{ __('Clear search') }}</a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                @if ($users->hasPages())
                    <div class="px-6 py-4 border-t border-sage-100 bg-sage-50/30">
                        {{ $users->appends(request()->query())->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection