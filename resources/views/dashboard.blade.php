<x-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            @if (Auth::user()->hasRole('admin'))
                <div class="border border-gold-300 bg-gold-50/80 rounded-xl px-6 py-3 flex items-center justify-between">
                    <span class="text-sm text-gold-800 font-medium">
                        {{ __("You're viewing the user dashboard as an admin.") }}
                    </span>
                    <a href="{{ route('admin.dashboard') }}" class="px-4 py-1.5 bg-gold-200 text-gold-800 text-sm font-medium hover:bg-gold-300 transition-colors rounded-lg">
                        {{ __('Back to Admin') }}
                    </a>
                </div>
            @endif

            {{-- Hero --}}
            <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-forest-600 via-forest-700 to-forest-800 px-8 md:px-12 py-12 md:py-16">
                <div class="relative z-10">
                    <div class="flex items-start justify-between flex-wrap gap-6">
                        <div class="max-w-2xl">
                            <p class="text-forest-300 text-xs font-medium uppercase tracking-[0.2em] mb-4">{{ __('Welcome') }}</p>
                            <h1 class="font-serif text-3xl md:text-4xl lg:text-5xl text-cream leading-[1.15]">
                                {{ __('Good') }}
                                @php $h = now()->hour; @endphp
                                @if ($h < 12) {{ __('Morning') }}
                                @elseif ($h < 17) {{ __('Afternoon') }}
                                @else {{ __('Evening') }}
                                @endif
                                , {{ Auth::user()->name }}
                            </h1>
                            <p class="text-forest-200 mt-3 text-base max-w-lg leading-relaxed">
                                {{ __('Small actions, sustainable future. Track your journey one step at a time.') }}
                            </p>
                        </div>

                        <a href="{{ route('achievements') }}" class="border border-gold-400/30 bg-forest-700/50 backdrop-blur-sm px-6 py-5 min-w-[180px] rounded-xl hover:bg-forest-700/70 transition-colors group">
                            <p class="text-xs text-forest-300 font-medium uppercase tracking-[0.15em]">{{ __('Achievement') }}</p>
                            <p class="font-serif text-xl text-gold-400 mt-2 group-hover:text-gold-300 transition-colors">{{ $badge }}</p>
                        </a>
                    </div>
                </div>
                <div class="absolute inset-0 opacity-[0.04]"
                     style="background-image: radial-gradient(circle at 25% 50%, #fff 1px, transparent 1px); background-size: 40px 40px;">
                </div>
            </div>

            {{-- Stats --}}
            <div class="grid grid-cols-1 md:grid-cols-4 gap-5">
                <div class="card p-6 animate-fade-up" style="animation-delay: 0.05s">
                    <div class="flex items-center justify-between mb-4">
                        <p class="stat-label">{{ __('Calories') }}</p>
                        <span class="text-xs text-muted/70">{{ __('Today') }}</span>
                    </div>
                    <p class="stat-value">{{ number_format($nutritionCalories) }} <span class="font-sans text-sm font-normal text-muted">kcal</span></p>
                    <div class="flex gap-4 mt-2 text-xs text-muted">
                        <span>P {{ number_format($nutritionProtein, 1) }}g</span>
                        <span>C {{ number_format($nutritionCarbs, 1) }}g</span>
                        <span>F {{ number_format($nutritionFat, 1) }}g</span>
                    </div>
                    <div class="progress-bar mt-4">
                        <div class="progress-fill" style="width: {{ min(($nutritionCalories / 2000) * 100, 100) }}%"></div>
                    </div>
                    <p class="text-xs text-muted/70 mt-2 text-right">{{ number_format(min(($nutritionCalories / 2000) * 100, 100)) }}% of 2000 kcal</p>
                </div>

                <div class="card p-6 animate-fade-up" style="animation-delay: 0.1s">
                    <div class="flex items-center justify-between mb-4">
                        <p class="stat-label">{{ __('Activity') }}</p>
                        <span class="text-xs text-muted/70">{{ __('Today') }}</span>
                    </div>
                    <p class="stat-value">{{ $activityMinutes }} <span class="font-sans text-sm font-normal text-muted">min</span></p>
                    <p class="text-xs text-muted mt-2">{{ $activityCalories }} kcal burned</p>
                    <div class="progress-bar mt-4">
                        <div class="progress-fill" style="width: {{ min(($activityMinutes / 30) * 100, 100) }}%"></div>
                    </div>
                    <p class="text-xs text-muted/70 mt-2 text-right">{{ number_format(min(($activityMinutes / 30) * 100, 100)) }}% of 30 min</p>
                </div>

                <div class="card p-6 animate-fade-up" style="animation-delay: 0.15s">
                    <div class="flex items-center justify-between mb-4">
                        <p class="stat-label">{{ __('Quiz Score') }}</p>
                        <span class="text-xs text-muted/70">{{ __('Today') }}</span>
                    </div>
                    <p class="stat-value">{{ $quizScore }} <span class="font-sans text-sm font-normal text-muted">pts</span></p>
                    <div class="progress-bar mt-4">
                        <div class="progress-fill" style="width: {{ min($quizScore, 100) }}%"></div>
                    </div>
                    <p class="text-xs text-muted/70 mt-2 text-right">{{ min($quizScore, 100) }}% of 100</p>
                </div>

                <div class="card p-6 animate-fade-up" style="animation-delay: 0.2s">
                    <div class="flex items-center justify-between mb-4">
                        <p class="stat-label">{{ __('SDG Goals') }}</p>
                        <span class="text-xs text-muted/70">All</span>
                    </div>
                    <p class="stat-value">17 <span class="font-sans text-sm font-normal text-muted">goals</span></p>
                    <div class="progress-bar mt-4">
                        <div class="progress-fill" style="width: 100%"></div>
                    </div>
                    <p class="text-xs text-muted/70 mt-2 text-right">100%</p>
                </div>
            </div>

            {{-- Weather --}}
            @if ($weather && $weather['weather'])
                <div class="card p-6 md:p-8 animate-fade-up" style="animation-delay: 0.1s">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="font-serif text-xl text-ink">{{ __('Weather') }}</h2>
                        <div class="flex items-center gap-2">
                            <span class="text-sm text-muted">{{ Auth::user()->city }}</span>
                            <button type="button" id="detectWeatherBtn"
                                class="text-xs text-muted hover:text-ink transition-colors px-3 py-1 border border-sage-200 rounded-lg hover:border-forest-300" title="{{ __('Update location') }}">
                                {{ __('Update') }}
                            </button>
                        </div>
                    </div>

                    <div class="flex flex-wrap items-start gap-6 mb-6">
                        <div>
                            <p class="font-serif text-5xl md:text-6xl text-ink leading-none">{{ $weather['weather']['temp'] }}&deg;C</p>
                            <p class="text-muted text-sm capitalize mt-2">{{ $weather['weather']['condition'] }}</p>
                        </div>
                        <div class="flex flex-wrap gap-3 ml-auto">
                            <div class="px-5 py-3 border border-sage-200 rounded-xl text-center">
                                <p class="stat-label">{{ __('Feels Like') }}</p>
                                <p class="font-medium text-ink mt-1">{{ $weather['weather']['feels_like'] }}&deg;C</p>
                            </div>
                            <div class="px-5 py-3 border border-sage-200 rounded-xl text-center">
                                <p class="stat-label">{{ __('Humidity') }}</p>
                                <p class="font-medium text-ink mt-1">{{ $weather['weather']['humidity'] }}%</p>
                            </div>
                            @if ($weather['airQuality'])
                                <div class="px-5 py-3 border border-sage-200 rounded-xl text-center">
                                    <p class="stat-label">{{ __('Air Quality') }}</p>
                                    <p class="font-medium text-ink mt-1">{{ $weather['airQuality']['level'] }}</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    @if ($weather['forecast'])
                        <div class="grid grid-cols-4 gap-3 pt-6 divider">
                            @foreach ($weather['forecast'] as $day)
                                <div class="text-center p-4 border border-sage-100 rounded-xl">
                                    <p class="text-xs font-medium text-ink mb-2">{{ $day['day_name'] }}</p>
                                    <p class="text-xs text-muted capitalize mb-2">{{ $day['condition'] }}</p>
                                    <p class="text-sm font-medium text-ink">{{ $day['temp_max'] }}&deg; / {{ $day['temp_min'] }}&deg;</p>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            @elseif (!Auth::user()->city)
                <div class="card p-8 md:p-12 text-center animate-fade-up" style="animation-delay: 0.15s">
                    <h2 class="font-serif text-xl text-ink mb-2">{{ __('Local Weather') }}</h2>
                    <p class="text-sm text-muted mb-6 max-w-md mx-auto">{{ __('Detect your location to see weather, air quality, and forecast.') }}</p>
                    <button type="button" id="detectWeatherBtn"
                        class="btn-primary">
                        {{ __('Detect My Location') }}
                    </button>
                    <p id="weatherStatus" class="text-xs text-muted mt-4"></p>
                </div>
            @else
                <div class="card p-6 bg-sage-50/50 rounded-xl">
                    <p class="font-medium text-ink">{{ __('Weather Unavailable') }}</p>
                    <p class="text-xs text-muted mt-1">{{ __('Weather data could not be loaded. Check your API configuration or city name.') }}</p>
                </div>
            @endif

            {{-- Daily Tip --}}
            @if ($dailyTip)
                <div class="card p-6 md:p-8 border-l-4 border-l-gold-400 animate-fade-up" style="animation-delay: 0.1s">
                    <div class="flex items-start gap-4">
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-4 mb-2">
                                <span class="text-xs font-medium text-gold-700 uppercase tracking-[0.15em]">{{ __('Tip of the Day') }}</span>
                                <span class="badge-forest">{{ $dailyTip->categoryLabel() }}</span>
                            </div>
                            <h3 class="font-serif text-lg text-ink">{{ $dailyTip->title }}</h3>
                            <p class="text-sm text-muted mt-1 leading-relaxed">{{ $dailyTip->excerptPreview(20) }}</p>
                            <a href="{{ route('articles.show', $dailyTip) }}" class="inline-flex items-center gap-1.5 mt-3 text-xs font-medium text-forest-600 hover:text-forest-700 transition-colors">
                                {{ __('Read More') }}
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7"/></svg>
                            </a>
                        </div>
                    </div>
                </div>
            @endif

            {{-- BMI --}}
            @php
                $bmi = Auth::user()->bmi();
                $bmiStatus = Auth::user()->bmiStatus();
            @endphp
            @if ($bmi && $bmiStatus)
                <div class="card p-6 md:p-8 animate-fade-up" style="animation-delay: 0.15s">
                    <div class="flex items-center justify-between flex-wrap gap-4">
                        <div>
                            <p class="stat-label">{{ __('Body Mass Index') }}</p>
                            <p class="stat-value mt-2">{{ $bmi }} <span class="font-sans text-sm font-normal text-muted">kg/m&sup2;</span></p>
                        </div>
                        <span class="px-4 py-2 text-sm font-medium border border-forest-300 bg-forest-50 text-forest-700 rounded-xl">{{ $bmiStatus }}</span>
                    </div>
                    <p class="text-xs text-muted/70 mt-4">Asian-specific BMI classification</p>
                </div>
            @else
                <div class="card p-6 md:p-8 bg-sage-50/50">
                    <p class="font-medium text-ink">{{ __('Body Mass Index') }}</p>
                    <p class="text-xs text-muted mt-1">{{ __('Set your weight and height in Profile to see your BMI.') }}</p>
                    <a href="{{ route('profile.edit') }}" class="inline-flex items-center mt-3 px-4 py-2 bg-forest-100 text-forest-700 font-medium text-xs hover:bg-forest-200 transition-colors rounded-lg">
                        {{ __('Complete Profile') }}
                    </a>
                </div>
            @endif

            {{-- Quick Actions --}}
            <div class="animate-fade-up" style="animation-delay: 0.2s">
                <h2 class="font-serif text-xl text-ink mb-5">{{ __('Quick Actions') }}</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <a href="{{ route('history') }}" class="card-hover card p-6 flex items-center gap-5 group">
                        <div>
                            <h3 class="font-serif text-lg text-ink group-hover:text-forest-600 transition-colors">{{ __('Activity History') }}</h3>
                            <p class="text-sm text-muted mt-0.5">{{ __('View your sustainability activities') }}</p>
                        </div>
                        <svg class="ml-auto w-5 h-5 text-muted group-hover:text-forest-500 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7"/></svg>
                    </a>

                    <a href="{{ route('activities') }}" class="card-hover card p-6 flex items-center gap-5 group">
                        <div>
                            <h3 class="font-serif text-lg text-ink group-hover:text-forest-600 transition-colors">{{ __('Activity Tracker') }}</h3>
                            <p class="text-sm text-muted mt-0.5">{{ __('Log your daily physical activities') }}</p>
                        </div>
                        <svg class="ml-auto w-5 h-5 text-muted group-hover:text-forest-500 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7"/></svg>
                    </a>

                    <a href="{{ route('nutrition.history') }}" class="card-hover card p-6 flex items-center gap-5 group">
                        <div>
                            <h3 class="font-serif text-lg text-ink group-hover:text-forest-600 transition-colors">{{ __('Nutrition History') }}</h3>
                            <p class="text-sm text-muted mt-0.5">{{ __('View your food and nutrition logs') }}</p>
                        </div>
                        <svg class="ml-auto w-5 h-5 text-muted group-hover:text-forest-500 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7"/></svg>
                    </a>

                    <a href="{{ route('learning') }}" class="card-hover card p-6 flex items-center gap-5 group">
                        <div>
                            <h3 class="font-serif text-lg text-ink group-hover:text-forest-600 transition-colors">{{ __('Learn') }}</h3>
                            <p class="text-sm text-muted mt-0.5">{{ __('Explore articles and SDGs') }}</p>
                        </div>
                        <svg class="ml-auto w-5 h-5 text-muted group-hover:text-forest-500 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7"/></svg>
                    </a>

                    <a href="{{ route('quiz') }}" class="card-hover card p-6 flex items-center gap-5 group">
                        <div>
                            <h3 class="font-serif text-lg text-ink group-hover:text-forest-600 transition-colors">{{ __('Quiz') }}</h3>
                            <p class="text-sm text-muted mt-0.5">{{ __('Test your knowledge') }}</p>
                        </div>
                        <svg class="ml-auto w-5 h-5 text-muted group-hover:text-forest-500 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7"/></svg>
                    </a>

                    <a href="{{ route('profile.edit') }}" class="card-hover card p-6 flex items-center gap-5 group">
                        <div>
                            <h3 class="font-serif text-lg text-ink group-hover:text-forest-600 transition-colors">{{ __('Profile') }}</h3>
                            <p class="text-sm text-muted mt-0.5">{{ __('Manage your account') }}</p>
                        </div>
                        <svg class="ml-auto w-5 h-5 text-muted group-hover:text-forest-500 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </div>

        </div>
    </div>

    @push('scripts')
    <script>
        document.getElementById('detectWeatherBtn')?.addEventListener('click', function() {
            const btn = this;
            const status = document.getElementById('weatherStatus');

            if (!navigator.geolocation) {
                if (status) status.textContent = 'Geolocation not supported. Type city in Profile.';
                return;
            }

            btn.disabled = true;
            btn.textContent = 'Detecting...';
            if (status) status.textContent = 'Getting your location...';

            navigator.geolocation.getCurrentPosition(
                function(pos) {
                    if (status) status.textContent = 'Finding your city...';
                    var form = new FormData();
                    form.append('lat', pos.coords.latitude);
                    form.append('lon', pos.coords.longitude);

                    fetch("{{ route('location.detect') }}", {
                        method: 'POST',
                        headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content },
                        body: form
                    })
                    .then(function(r) { return r.json(); })
                    .then(function(data) {
                        if (data.city) {
                            if (status) status.textContent = 'Detected: ' + data.city + '. Reloading...';
                            location.reload();
                        } else {
                            if (status) status.textContent = 'Could not detect city.';
                            btn.disabled = false;
                            btn.textContent = 'Detect My Location';
                        }
                    })
                    .catch(function() {
                        if (status) status.textContent = 'Service unavailable. Try again.';
                        btn.disabled = false;
                        btn.textContent = 'Detect My Location';
                    });
                },
                function(err) {
                    var msgs = { 1: 'Location denied.', 2: 'Location unavailable.', 3: 'Timed out.' };
                    if (status) status.textContent = msgs[err.code] || 'Detection failed.';
                    btn.disabled = false;
                    btn.textContent = 'Detect My Location';
                },
                { enableHighAccuracy: true, timeout: 10000, maximumAge: 300000 }
            );
        });
    </script>
    @endpush

</x-app-layout>
