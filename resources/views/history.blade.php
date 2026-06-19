<x-app-layout>
    <x-slot name="header">
        <h2 class="font-display text-2xl text-forest-800">&#128214; {{ __('Activity History') }}</h2>
    </x-slot>

    <div class="max-w-5xl mx-auto py-8 px-4 space-y-6">
        @forelse($histories as $history)
            @php
                $score = 0;
                if($history->quiz_score >= 60) $score++;
                if(($history->activity_minutes ?? 0) >= 30) $score++;
            @endphp

            @php
                $dateKey = \Carbon\Carbon::parse($history->history_date)->toDateString();
                $dayActivities = $activitiesByDate[$dateKey] ?? collect();
            @endphp

            <a href="{{ route('report', ['date' => $dateKey]) }}" class="block card p-6 hover:ring-2 hover:ring-forest-300 transition-all">
                <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-forest-100 flex items-center justify-center text-sm font-bold text-forest-700">
                            {{\Carbon\Carbon::parse($history->history_date)->format('d')}}
                        </div>
                        <div>
                            <h3 class="font-bold text-forest-700">
                                {{\Carbon\Carbon::parse($history->history_date)->locale(app()->getLocale())->diffForHumans()}}
                            </h3>
                        </div>
                    </div>

                    @if($score >= 2)
                        <span class="badge-green">&#127775; {{ __('Excellent') }}</span>
                    @elseif($score >= 1)
                        <span class="badge-gold">&#128077; {{ __('Good') }}</span>
                    @else
                        <span class="badge-clay">&#128640; {{ __('Keep Going') }}</span>
                    @endif
                </div>

                <div class="grid md:grid-cols-4 gap-4">
                    @php
                        $dayNutrition = $nutritionByDate[$dateKey] ?? collect();
                        $nutTotals = (object)[
                            'calories' => $dayNutrition->sum('calories'),
                            'protein_g' => $dayNutrition->sum('protein_g'),
                            'carbs_g' => $dayNutrition->sum('carbs_g'),
                            'sugar_g' => $dayNutrition->sum('sugar_g'),
                            'fat_g' => $dayNutrition->sum('fat_g'),
                        ];
                    @endphp
                    <div class="bg-orange-50 rounded-2xl p-5 border border-orange-100">
                        <p class="text-2xl mb-1">&#127858;</p>
                        <p class="text-sm font-semibold text-forest-700">{{ __('Nutrition') }}</p>
                        <p class="text-lg font-bold text-orange-600">{{ number_format($nutTotals->calories) }} kcal</p>
                        @if ($dayNutrition->count() > 0)
                            <p class="text-xs text-sage-500 mt-1">P {{ number_format($nutTotals->protein_g, 1) }}g &bull; F {{ number_format($nutTotals->fat_g, 1) }}g</p>
                        @else
                            <p class="text-xs text-sage-400 mt-1">{{ __('No food logged') }}</p>
                        @endif
                    </div>

                    <div class="bg-gold-50 rounded-2xl p-5 border border-gold-100">
                        <p class="text-2xl mb-1">&#128221;</p>
                        <p class="text-sm font-semibold text-forest-700">{{ __('Quiz') }}</p>
                        <p class="text-lg font-bold text-gold-600">{{ $history->quiz_score }}%</p>
                    </div>

                    <div class="bg-orange-50 rounded-2xl p-5 border border-orange-100">
                        <p class="text-2xl mb-1">&#127939;</p>
                        <p class="text-sm font-semibold text-forest-700">{{ __('Activity') }}</p>
                        <p class="text-lg font-bold text-orange-600">
                            {{ $history->activity_minutes ?? $dayActivities->sum('duration_minutes') }} min
                        </p>
                        @if ($history->activity_calories ?? $dayActivities->sum('calories_burned'))
                            <p class="text-xs text-orange-500">{{ $history->activity_calories ?? $dayActivities->sum('calories_burned') }} kcal</p>
                        @endif
                    </div>

                    <div class="bg-amber-50 rounded-2xl p-5 border border-amber-100">
                        <p class="text-2xl mb-1">&#127838;</p>
                        <p class="text-sm font-semibold text-forest-700">{{ __('Carbs & Sugar') }}</p>
                        <p class="text-lg font-bold text-amber-600">{{ number_format($nutTotals->carbs_g, 1) }}g</p>
                        <p class="text-xs text-sage-500 mt-1">Gula {{ number_format($nutTotals->sugar_g, 1) }}g</p>
                    </div>
                </div>

                @if ($dayActivities->count() > 0)
                    <div class="mt-4 pt-4 border-t border-sage-100">
                        <p class="text-xs font-semibold text-sage-500 mb-2 uppercase tracking-wider">{{ __('Activity Details') }}</p>
                        <div class="flex flex-wrap gap-2">
                            @foreach ($dayActivities as $act)
                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-medium bg-orange-50 text-orange-700 border border-orange-200">
                                    {{ str_replace('_', ' ', $act->activity_type) }} &bull; {{ $act->duration_minutes }}min
                                    @if ($act->distance_km) &bull; {{ $act->distance_km }}km @endif
                                    @if ($act->calories_burned) ({{ $act->calories_burned }}kcal) @endif
                                </span>
                            @endforeach
                    </div>
                @endif
            </a>

        @empty
            <div class="card p-12 text-center">
                <p class="text-5xl mb-4">&#128214;</p>
                <h3 class="font-display text-2xl text-forest-800 mb-2">{{ __('No Activity Yet') }}</h3>
                <p class="text-sage-500">{{ __('Start using EcoLife Hub to build your history.') }}</p>
                <a href="{{ route('dashboard') }}" class="btn-primary mt-6">
                    {{ __('Go to Dashboard') }}
                </a>
            </div>
        @endforelse
    </div>
</x-app-layout>
