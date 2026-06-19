<x-app-layout>
    <div class="max-w-4xl mx-auto py-10 px-4 space-y-8">

        @if (session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-6 py-4 rounded-2xl text-sm font-medium">
                &#10004; {{ session('success') }}
            </div>
        @endif

        {{-- No weight warning --}}
        @if (!auth()->user()->weight_kg || !auth()->user()->height_cm)
            <div class="bg-yellow-50 border border-yellow-200 text-yellow-800 px-6 py-5 rounded-2xl">
                <div class="flex items-start gap-3">
                    <span class="text-xl">&#9888;</span>
                    <div>
                        <p class="font-bold">{{ __('Body data missing') }}</p>
                        <p class="text-sm text-yellow-700 mt-1">{{ __('Please set your weight and height in Profile first to unlock calorie estimation.') }}</p>
                        <a href="{{ route('profile.edit') }}" class="inline-flex items-center mt-3 px-4 py-2 bg-yellow-100 hover:bg-yellow-200 text-yellow-800 font-semibold rounded-xl text-sm transition-colors">
                            {{ __('Go to Profile') }}
                        </a>
                    </div>
                </div>
            </div>
        @endif

        {{-- Header --}}
        <div class="card p-8">
            <div class="flex items-center gap-4 mb-8">
                <div class="w-16 h-16 rounded-2xl bg-orange-100 flex items-center justify-center text-4xl">
                    &#127939;
                </div>
                <div>
                    <h1 class="font-display text-3xl text-forest-800">{{ __('Activity Tracker') }}</h1>
                    <p class="text-sage-500">{{ __('Log your daily physical activities') }}</p>
                </div>
            </div>

            <div class="grid md:grid-cols-3 gap-6 mb-8">
                <div class="bg-orange-50 rounded-2xl p-6 border border-orange-100">
                    <p class="text-sm font-medium text-orange-600 mb-1">&#9200; {{ __("Today's Total") }}</p>
                    <p class="font-display text-4xl text-orange-700">{{ $totalMinutes }}</p>
                    <p class="text-orange-500 text-sm mt-1">{{ __('minutes active') }}</p>
                </div>
                <div class="bg-rose-50 rounded-2xl p-6 border border-rose-100">
                    <p class="text-sm font-medium text-rose-600 mb-1">&#128293; {{ __('Calories Burned') }}</p>
                    <p class="font-display text-4xl text-rose-700">{{ $totalCalories }}</p>
                    <p class="text-rose-500 text-sm mt-1">{{ __('kcal today') }}</p>
                </div>
                <div class="bg-blue-50 rounded-2xl p-6 border border-blue-100">
                    <p class="text-sm font-medium text-blue-600 mb-1">&#128205; {{ __('Distance') }}</p>
                    <p class="font-display text-4xl text-blue-700">{{ number_format($totalDistance, 2) }}</p>
                    <p class="text-blue-500 text-sm mt-1">{{ __('km today') }}</p>
                </div>
            </div>

            <div class="progress-bar h-3 mb-6">
                @php $activityPercent = min(($totalMinutes / 30) * 100, 100); @endphp
                <div class="progress-fill bg-orange-500" style="width: {{ $activityPercent }}%"></div>
            </div>

            {{-- Today's Activities --}}
            @if ($todaysActivities->count() > 0)
                <h3 class="font-semibold text-forest-700 mb-3">&#128203; {{ __("Today's Activities") }}</h3>
                <div class="space-y-3 mb-8">
                    @foreach ($todaysActivities as $activity)
                        <div class="flex items-center justify-between bg-sage-50 rounded-xl px-5 py-3 border border-sage-100">
                            <div class="flex items-center gap-3">
                                <span class="text-xl">{!! $activity->icon() !!}</span>
                                <div>
                                    <p class="font-semibold text-forest-700">{{ $activity->label() }}</p>
                                    <p class="text-xs text-sage-500">
                                        {{ $activity->duration_minutes }} min
                                        @if ($activity->distance_km)
                                            &bull; {{ $activity->distance_km }} km
                                        @endif
                                        @if ($activity->pace_intensity)
                                            &bull; {{ str_replace('_', ' ', $activity->pace_intensity) }}
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                @if ($activity->calories_burned)
                                    <span class="text-sm font-bold text-rose-600">{{ $activity->calories_burned }} kcal</span>
                                @endif
                                <form action="{{ route('activities.destroy', $activity) }}" method="POST" onsubmit="return confirm('{{ __('Delete this activity?') }}')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-1.5 rounded-lg text-sage-400 hover:text-red-500 hover:bg-red-50 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            {{-- Log Activity Form --}}
            <h3 class="font-display text-xl text-forest-800 mb-4">&#128221; {{ __('Log New Activity') }}</h3>
            <form action="{{ route('activities.store') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label for="activity_type" class="input-label">{{ __('Activity Type') }}</label>
                    <select name="activity_type" id="activity_type" class="input-field" required>
                        <option value="">{{ __('Select an activity...') }}</option>
                        <option value="walking">&#128694; {{ __('Walking') }}</option>
                        <option value="running">&#127939; {{ __('Running') }} / Jogging</option>
                        <option value="cycling">&#128690; {{ __('Cycling') }}</option>
                        <option value="swimming">&#127946; {{ __('Swimming') }}</option>
                        <option value="yoga">&#129518; {{ __('Yoga') }} / Stretching</option>
                        <option value="strength">&#128170; {{ __('Strength Training') }}</option>
                        <option value="dancing">&#128131; {{ __('Dancing') }}</option>
                        <option value="hiking">&#9968; {{ __('Hiking') }}</option>
                        <option value="sports">&#127944; {{ __('Sports') }}</option>
                        <option value="other">&#127775; {{ __('Other') }}</option>
                    </select>
                    <x-input-error :messages="$errors->get('activity_type')" />
                </div>

                {{-- Pace / Intensity --}}
                <div id="pace_intensity_wrapper" class="hidden">
                    <label for="pace_intensity" class="input-label">{{ __('Pace / Intensity') }}</label>
                    <select name="pace_intensity" id="pace_intensity" class="input-field">
                        <option value="">{{ __('Select intensity...') }}</option>
                    </select>
                    <x-input-error :messages="$errors->get('pace_intensity')" />
                    <p id="pace_hint" class="text-xs text-sage-400 mt-1"></p>
                </div>

                <div>
                    <label for="duration_minutes" class="input-label">{{ __('Duration') }} ({{ __('minutes') }})</label>
                    <input type="number" name="duration_minutes" id="duration_minutes" min="1" max="1440" class="input-field" placeholder="e.g. 30" value="{{ old('duration_minutes') }}" required>
                    <x-input-error :messages="$errors->get('duration_minutes')" />
                </div>

                {{-- Distance --}}
                <div id="distance_wrapper" class="hidden">
                    <label for="distance_km" class="input-label">{{ __('Distance') }} <span class="text-sage-400 font-normal">(km)</span></label>
                    <input type="number" name="distance_km" id="distance_km" step="0.01" min="0" max="999.99" class="input-field" placeholder="e.g. 5.2" value="{{ old('distance_km') }}">
                    <x-input-error :messages="$errors->get('distance_km')" />
                </div>

                <div>
                    <label for="notes" class="input-label">{{ __('Notes') }} <span class="text-sage-400 font-normal">({{ __('Optional') }})</span></label>
                    <textarea name="notes" id="notes" rows="2" class="input-field" placeholder="How did it go?">{{ old('notes') }}</textarea>
                    <x-input-error :messages="$errors->get('notes')" />
                </div>

                <button type="submit" class="w-full btn-primary justify-center text-base py-4">
                    {{ __('+ Log Activity') }}
                </button>
            </form>
        </div>

        {{-- Activity History with Filter --}}
        <div class="card p-8">
            <div class="flex items-center justify-between mb-6">
                <h2 class="font-display text-2xl text-forest-800">&#128337; {{ __('Activity History') }}</h2>
            </div>

            {{-- Filter Tabs --}}
            <form action="{{ route('activities') }}" method="GET" class="mb-6" id="filterForm">
                <div class="flex flex-wrap gap-2 mb-4">
                    @php $presets = ['today' => __('Today'), 'week' => __('This Week'), 'month' => __('This Month'), 'all' => __('All Time')]; @endphp
                    @foreach ($presets as $key => $label)
                        <button type="submit" name="filter" value="{{ $key }}"
                            class="px-4 py-2 rounded-xl text-sm font-medium transition-colors
                            {{ $filter === $key && !request('start_date') ? 'bg-forest-600 text-white' : 'bg-sage-100 text-sage-700 hover:bg-sage-200' }}">
                            {{ $label }}
                        </button>
                    @endforeach
                </div>

                {{-- Custom Date Range --}}
                <div class="flex flex-wrap items-end gap-3">
                    <div>
                        <label for="start_date" class="text-xs font-medium text-sage-500 block mb-1">{{ __('From') }}</label>
                        <input type="date" name="start_date" id="start_date" value="{{ request('start_date') }}"
                            class="input-field text-sm px-3 py-2">
                    </div>
                    <div>
                        <label for="end_date" class="text-xs font-medium text-sage-500 block mb-1">{{ __('To') }}</label>
                        <input type="date" name="end_date" id="end_date" value="{{ request('end_date') }}"
                            class="input-field text-sm px-3 py-2">
                    </div>
                    <button type="submit" name="filter" value="custom"
                        class="px-4 py-2 bg-forest-600 text-white rounded-xl text-sm font-medium hover:bg-forest-700 transition-colors">
                        {{ __('Apply') }}
                    </button>
                    @if ($filter !== 'week' || request('start_date'))
                        <a href="{{ route('activities') }}" class="px-4 py-2 text-sage-500 hover:text-sage-700 text-sm font-medium transition-colors">
                            &times; {{ __('Reset') }}
                        </a>
                    @endif
                </div>
            </form>

            {{-- Period Summary Stats --}}
            <div class="grid grid-cols-4 gap-4 mb-6">
                <div class="bg-sage-50 rounded-xl px-4 py-3 border border-sage-100 text-center">
                    <p class="text-2xl font-bold text-forest-700">{{ $activityCount }}</p>
                    <p class="text-xs text-sage-500">{{ __('Activities') }}</p>
                </div>
                <div class="bg-orange-50 rounded-xl px-4 py-3 border border-orange-100 text-center">
                    <p class="text-2xl font-bold text-orange-700">{{ $filteredMinutes }}</p>
                    <p class="text-xs text-orange-500">{{ __('Minutes') }}</p>
                </div>
                <div class="bg-rose-50 rounded-xl px-4 py-3 border border-rose-100 text-center">
                    <p class="text-2xl font-bold text-rose-700">{{ $filteredCalories }}</p>
                    <p class="text-xs text-rose-500">kcal</p>
                </div>
                <div class="bg-blue-50 rounded-xl px-4 py-3 border border-blue-100 text-center">
                    <p class="text-2xl font-bold text-blue-700">{{ number_format($filteredDistance, 2) }}</p>
                    <p class="text-xs text-blue-500">km</p>
                </div>
            </div>

            {{-- Activities List --}}
            @if ($filteredActivities->count() > 0)
                <div class="space-y-3">
                    @foreach ($filteredActivities as $activity)
                        <div class="flex items-center justify-between bg-sage-50 rounded-xl px-5 py-3 border border-sage-100">
                            <div class="flex items-center gap-3">
                                <span class="text-xl">{!! $activity->icon() !!}</span>
                                <div>
                                    <p class="font-semibold text-forest-700">{{ $activity->label() }}</p>
                                    <p class="text-xs text-sage-500">
                                        {{ $activity->duration_minutes }} min
                                        @if ($activity->distance_km)
                                            &bull; {{ $activity->distance_km }} km
                                        @endif
                                        @if ($activity->pace_intensity)
                                            &bull; {{ str_replace('_', ' ', $activity->pace_intensity) }}
                                        @endif
                                        &bull; {{ $activity->activity_date->locale(app()->getLocale())->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                @if ($activity->calories_burned)
                                    <span class="text-sm font-bold text-rose-600">{{ $activity->calories_burned }} kcal</span>
                                @endif
                                <form action="{{ route('activities.destroy', $activity) }}" method="POST" onsubmit="return confirm('{{ __('Delete this activity?') }}')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-1.5 rounded-lg text-sage-400 hover:text-red-500 hover:bg-red-50 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12 bg-sage-50 rounded-2xl border border-dashed border-sage-200">
                    <p class="text-4xl mb-3">&#128270;</p>
                    <p class="text-sage-500 font-medium">{{ __('No activities found for this period.') }}</p>
                    <p class="text-sage-400 text-sm mt-1">{{ __('Try a different date range.') }}</p>
                </div>
            @endif
        </div>
    </div>

    @push('scripts')
    <script>
        document.querySelectorAll('#filterForm button[name="filter"]').forEach(btn => {
            btn.addEventListener('click', function(e) {
                if (this.value !== 'custom') {
                    document.getElementById('start_date').value = '';
                    document.getElementById('end_date').value = '';
                }
            });
        });

        const intensityData = {
            walking: {
                options: [
                    { value: 'slow', label: 'Slow Walk (~3 km/h)' },
                    { value: 'moderate', label: 'Moderate Walk (~5 km/h)' },
                    { value: 'brisk', label: 'Brisk Walk (~6 km/h)' },
                    { value: 'fast', label: 'Fast Walk (~7 km/h)' },
                ],
                hint: 'Walking pace determines calorie burn — faster pace = more calories'
            },
            running: {
                options: [
                    { value: 'light_jog', label: 'Light Jog (~8 km/h, 7:30/km)' },
                    { value: 'moderate_run', label: 'Moderate Run (~10 km/h, 6:00/km)' },
                    { value: 'fast_run', label: 'Fast Run (~12 km/h, 5:00/km)' },
                    { value: 'sprint', label: 'Sprint (~16 km/h, 3:45/km)' },
                ],
                hint: 'Running pace directly affects MET — faster pace = more calories per minute'
            },
            cycling: {
                options: [
                    { value: 'leisure', label: 'Leisure (~10-12 km/h)' },
                    { value: 'moderate', label: 'Moderate (~16-19 km/h)' },
                    { value: 'fast', label: 'Fast (~20-23 km/h)' },
                    { value: 'vigorous', label: 'Vigorous (~24+ km/h)' },
                ],
                hint: 'Higher cycling speed requires more effort and burns more calories'
            },
            swimming: {
                options: [
                    { value: 'light', label: 'Light / Leisurely' },
                    { value: 'moderate', label: 'Moderate' },
                    { value: 'vigorous', label: 'Vigorous / Laps' },
                ],
                hint: 'Swimming intensity determines full-body calorie burn'
            },
            yoga: {
                options: [
                    { value: 'gentle', label: 'Gentle / Hatha' },
                    { value: 'hatha', label: 'Hatha Yoga' },
                    { value: 'power', label: 'Power / Vinyasa' },
                ],
                hint: 'More active yoga styles like Vinyasa burn more calories'
            },
            strength: {
                options: [
                    { value: 'light', label: 'Light / Low Weight' },
                    { value: 'moderate', label: 'Moderate Weight' },
                    { value: 'vigorous', label: 'Heavy / High Intensity' },
                ],
                hint: 'Heavier weights and shorter rest periods increase calorie burn'
            },
            dancing: {
                options: [
                    { value: 'slow', label: 'Slow Dance' },
                    { value: 'moderate', label: 'Moderate Dance' },
                    { value: 'fast', label: 'Energetic / Fast Dance' },
                ],
                hint: 'More energetic dancing elevates heart rate and calorie burn'
            },
            hiking: {
                options: [
                    { value: 'flat', label: 'Flat Terrain' },
                    { value: 'moderate', label: 'Moderate Hills' },
                    { value: 'steep', label: 'Steep / Mountainous' },
                ],
                hint: 'Steeper terrain requires more energy — hills burn more calories'
            },
            sports: {
                options: [
                    { value: 'casual', label: 'Casual Play' },
                    { value: 'moderate', label: 'Moderate / Recreational' },
                    { value: 'competitive', label: 'Competitive / Intense' },
                ],
                hint: 'Competitive sports burn significantly more than casual play'
            },
        };

        const activityTypesWithDistance = ['walking', 'running', 'cycling', 'swimming', 'hiking'];

        const activityType = document.getElementById('activity_type');
        const paceWrapper = document.getElementById('pace_intensity_wrapper');
        const paceSelect = document.getElementById('pace_intensity');
        const paceHint = document.getElementById('pace_hint');
        const distanceWrapper = document.getElementById('distance_wrapper');

        activityType.addEventListener('change', function() {
            const type = this.value;
            const data = intensityData[type];

            if (!data) {
                paceWrapper.classList.add('hidden');
                distanceWrapper.classList.add('hidden');
                return;
            }

            paceWrapper.classList.remove('hidden');
            paceSelect.innerHTML = '<option value="">{{ __('Select intensity...') }}</option>';
            data.options.forEach(opt => {
                const el = document.createElement('option');
                el.value = opt.value;
                el.textContent = opt.label;
                paceSelect.appendChild(el);
            });
            paceHint.textContent = data.hint || '';

            if (activityTypesWithDistance.includes(type)) {
                distanceWrapper.classList.remove('hidden');
            } else {
                distanceWrapper.classList.add('hidden');
            }
        });
    </script>
    @endpush
</x-app-layout>
