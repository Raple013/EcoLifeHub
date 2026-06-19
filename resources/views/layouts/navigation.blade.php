<nav x-data="{ open: false }" class="bg-white/95 backdrop-blur-md border-b border-sage-100 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center gap-10">
                <a href="{{ route('dashboard') }}" class="font-serif text-xl text-forest-600 tracking-tight">
                    EcoLife Hub
                </a>

                <div class="hidden sm:flex items-center gap-8">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'nav-link-active' : '' }}">
                        {{ __('Dashboard') }}
                    </a>
                    <a href="{{ route('nutrition.index') }}" class="nav-link {{ request()->routeIs('nutrition.*') ? 'nav-link-active' : '' }}">
                        {{ __('Nutrition') }}
                    </a>
                    <a href="{{ route('activities') }}" class="nav-link {{ request()->routeIs('activities') ? 'nav-link-active' : '' }}">
                        {{ __('Activity') }}
                    </a>
                    <a href="{{ route('learning') }}" class="nav-link {{ request()->routeIs('learning') ? 'nav-link-active' : '' }}">
                        {{ __('Learn') }}
                    </a>
                    <a href="{{ route('quiz') }}" class="nav-link {{ request()->routeIs('quiz') ? 'nav-link-active' : '' }}">
                        {{ __('Quiz') }}
                    </a>
                    <a href="{{ route('discussions.index') }}" class="nav-link {{ request()->routeIs('discussions.*') ? 'nav-link-active' : '' }}">
                        {{ __('Discuss') }}
                    </a>
                    <a href="{{ route('history') }}" class="nav-link {{ request()->routeIs('history') ? 'nav-link-active' : '' }}">
                        {{ __('History') }}
                    </a>
                    @if (Auth::user()?->hasRole('admin'))
                        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.*') ? 'nav-link-active' : '' }}">
                            {{ __('Admin') }}
                        </a>
                    @endif
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:gap-6">
                <form action="{{ route('language.switch', app()->getLocale() === 'id' ? 'en' : 'id') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="px-3 py-1.5 border border-sage-200 text-xs font-medium text-muted hover:text-ink hover:border-forest-400 transition-colors tracking-wide rounded-lg">
                        {{ app()->getLocale() === 'id' ? 'EN' : 'ID' }}
                    </button>
                </form>

                <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 btn-ghost">
                    @if (Auth::user()->hasPhoto())
                        <img src="{{ Auth::user()->photoUrl() }}" alt="" class="w-7 h-7 rounded-full object-cover">
                    @else
                        <div class="w-7 h-7 rounded-full bg-forest-100 flex items-center justify-center text-xs font-bold text-forest-700">
                            {{ Auth::user()->initials() }}
                        </div>
                    @endif
                    {{ Auth::user()->name }}
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-ghost">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>

            {{-- Mobile toggle --}}
            <div class="flex items-center sm:hidden">
                <button @click="open = ! open" class="p-2 text-muted hover:text-ink transition-colors">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile menu --}}
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden border-t border-sage-100 bg-white/95 backdrop-blur-md">
        <div class="px-4 py-3 space-y-1">
            <a href="{{ route('dashboard') }}" class="block px-4 py-2.5 text-sm {{ request()->routeIs('dashboard') ? 'text-ink font-semibold' : 'text-muted' }}">
                {{ __('Dashboard') }}
            </a>
            <a href="{{ route('nutrition.index') }}" class="block px-4 py-2.5 text-sm {{ request()->routeIs('nutrition.*') ? 'text-ink font-semibold' : 'text-muted' }}">
                {{ __('Nutrition') }}
            </a>
            <a href="{{ route('activities') }}" class="block px-4 py-2.5 text-sm {{ request()->routeIs('activities') ? 'text-ink font-semibold' : 'text-muted' }}">
                {{ __('Activity') }}
            </a>
            <a href="{{ route('learning') }}" class="block px-4 py-2.5 text-sm {{ request()->routeIs('learning') ? 'text-ink font-semibold' : 'text-muted' }}">
                {{ __('Learn') }}
            </a>
            <a href="{{ route('quiz') }}" class="block px-4 py-2.5 text-sm {{ request()->routeIs('quiz') ? 'text-ink font-semibold' : 'text-muted' }}">
                {{ __('Quiz') }}
            </a>
            <a href="{{ route('discussions.index') }}" class="block px-4 py-2.5 text-sm {{ request()->routeIs('discussions.*') ? 'text-ink font-semibold' : 'text-muted' }}">
                {{ __('Discuss') }}
            </a>
            <a href="{{ route('history') }}" class="block px-4 py-2.5 text-sm {{ request()->routeIs('history') ? 'text-ink font-semibold' : 'text-muted' }}">
                {{ __('History') }}
            </a>
            @if (Auth::user()?->hasRole('admin'))
                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2.5 text-sm {{ request()->routeIs('admin.*') ? 'text-ink font-semibold' : 'text-muted' }}">
                    {{ __('Admin') }}
                </a>
            @endif
        </div>

        <div class="border-t border-sage-100 px-4 py-4 space-y-3">
                        <div class="px-4 flex items-center gap-3">
                                @if (Auth::user()->hasPhoto())
                                    <img src="{{ Auth::user()->photoUrl() }}" alt="" class="w-10 h-10 rounded-full object-cover">
                                @else
                                    <div class="w-10 h-10 rounded-full bg-forest-100 flex items-center justify-center text-sm font-bold text-forest-700">
                                        {{ Auth::user()->initials() }}
                                    </div>
                                @endif
                                <div>
                                    <p class="text-sm font-medium text-ink">{{ Auth::user()->name }}</p>
                                    <p class="text-xs text-muted">{{ Auth::user()->email }}</p>
                                </div>
                            </div>

            <form action="{{ route('language.switch', app()->getLocale() === 'id' ? 'en' : 'id') }}" method="POST" class="px-4">
                @csrf
                <button type="submit" class="w-full text-center px-4 py-2 border border-sage-200 text-xs font-medium text-muted hover:text-ink transition-colors tracking-wide rounded-lg">
                    {{ app()->getLocale() === 'id' ? 'English' : 'Bahasa' }}
                </button>
            </form>

            <a href="{{ route('profile.edit') }}" class="block px-4 py-2.5 text-sm text-muted">
                {{ __('Profile') }}
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-2.5 text-sm text-muted hover:text-ink">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </div>
</nav>
