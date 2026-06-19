<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <h2 class="font-display text-2xl text-forest-800">&#128200; {{ __('Daily Report') }} — {{ \Carbon\Carbon::parse($date)->format('d M Y') }}</h2>
            <div class="flex gap-2">
                <a href="{{ route('report', ['date' => \Carbon\Carbon::parse($date)->subDay()->toDateString()]) }}" class="px-4 py-2 rounded-xl text-sm font-medium bg-sage-100 text-sage-700 hover:bg-sage-200 transition-colors">&larr; {{ __('Previous') }}</a>
                <a href="{{ route('report', ['date' => \Carbon\Carbon::parse($date)->addDay()->toDateString()]) }}" class="px-4 py-2 rounded-xl text-sm font-medium bg-sage-100 text-sage-700 hover:bg-sage-200 transition-colors">{{ __('Next') }} &rarr;</a>
            </div>
        </div>
    </x-slot>

    <div class="max-w-5xl mx-auto py-8 px-4 space-y-6">

        {{-- Summary Cards --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="bg-orange-50 rounded-2xl p-5 border border-orange-100 text-center">
                <p class="text-2xl mb-1">&#127858;</p>
                <p class="text-xs text-sage-500">{{ __('Calories') }}</p>
                <p class="text-xl font-bold text-orange-600">{{ number_format($nutritionTotals->calories) }} kcal</p>
            </div>
            <div class="bg-blue-50 rounded-2xl p-5 border border-blue-100 text-center">
                <p class="text-2xl mb-1">&#129372;</p>
                <p class="text-xs text-sage-500">{{ __('Protein') }}</p>
                <p class="text-xl font-bold text-blue-600">{{ number_format($nutritionTotals->protein_g, 1) }}g</p>
            </div>
            <div class="bg-amber-50 rounded-2xl p-5 border border-amber-100 text-center">
                <p class="text-2xl mb-1">&#127838;</p>
                <p class="text-xs text-sage-500">{{ __('Carbs') }}</p>
                <p class="text-xl font-bold text-amber-600">{{ number_format($nutritionTotals->carbs_g, 1) }}g</p>
            </div>
            <div class="bg-purple-50 rounded-2xl p-5 border border-purple-100 text-center">
                <p class="text-2xl mb-1">&#129473;</p>
                <p class="text-xs text-sage-500">{{ __('Fat') }}</p>
                <p class="text-xl font-bold text-purple-600">{{ number_format($nutritionTotals->fat_g, 1) }}g</p>
            </div>
            <div class="bg-rose-50 rounded-2xl p-5 border border-rose-100 text-center">
                <p class="text-2xl mb-1">&#127850;</p>
                <p class="text-xs text-sage-500">{{ __('Sugar') }}</p>
                <p class="text-xl font-bold text-rose-600">{{ number_format($nutritionTotals->sugar_g, 1) }}g</p>
            </div>
            <div class="bg-gold-50 rounded-2xl p-5 border border-gold-100 text-center">
                <p class="text-2xl mb-1">&#128221;</p>
                <p class="text-xs text-sage-500">{{ __('Quiz') }}</p>
                <p class="text-xl font-bold text-gold-600">{{ $dailyHistory->quiz_score ?? 0 }}%</p>
            </div>
            <div class="bg-orange-50 rounded-2xl p-5 border border-orange-100 text-center">
                <p class="text-2xl mb-1">&#127939;</p>
                <p class="text-xs text-sage-500">{{ __('Activity') }}</p>
                <p class="text-xl font-bold text-orange-600">{{ $activityTotals->minutes }} min</p>
            </div>
        </div>

        {{-- Nutrition Logs --}}
        <div class="bg-white rounded-2xl border border-sage-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-sage-100 flex items-center gap-3">
                <span class="text-xl">&#127858;</span>
                <h3 class="font-bold text-forest-700">{{ __('Food & Drinks') }}</h3>
                <span class="text-xs text-sage-400 ml-auto">{{ $nutritionLogs->count() }} {{ __('items') }} &bull; {{ number_format($nutritionTotals->calories) }} kcal</span>
            </div>

            @if ($nutritionLogs->count() > 0)
                <div class="divide-y divide-sage-50">
                    @foreach ($nutritionLogs as $log)
                        <div class="px-6 py-4 flex items-start gap-4">
                            @if ($log->image_url)
                                <img src="{{ Storage::url($log->image_url) }}" class="w-14 h-14 rounded-2xl object-cover shrink-0">
                            @else
                                <div class="w-14 h-14 rounded-2xl bg-sage-100 flex items-center justify-center text-2xl shrink-0">&#127858;</div>
                            @endif
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between gap-2">
                                    <div>
                                        <p class="font-semibold text-forest-700">{{ $log->food_name }}</p>
                                        <p class="text-xs text-sage-500">
                                            {{ $log->meal_type === 'makanan_berat' ? __('Makanan Berat') : ($log->meal_type === 'minuman' ? __('Minuman') : __('Snack')) }}
                                            &bull; {{ \Carbon\Carbon::parse($log->logged_at)->format('H:i') }}
                                        </p>
                                    </div>
                                    <p class="font-bold text-orange-600 text-lg shrink-0">{{ number_format($log->calories) }} kcal</p>
                                </div>
                                <div class="flex flex-wrap gap-x-4 gap-y-1 mt-2 text-xs">
                                    @if ($log->protein_g > 0)<span class="text-blue-600">P {{ number_format($log->protein_g, 1) }}g</span>@endif
                                    @if ($log->carbs_g > 0)<span class="text-amber-600">C {{ number_format($log->carbs_g, 1) }}g</span>@endif
                                    @if ($log->sugar_g > 0)<span class="text-rose-600">G {{ number_format($log->sugar_g, 1) }}g</span>@endif
                                    @if ($log->fat_g > 0)<span class="text-purple-600">F {{ number_format($log->fat_g, 1) }}g</span>@endif
                                    @if ($log->source)<span class="text-sage-400 italic">{{ $log->source }}</span>@endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="px-6 py-10 text-center">
                    <p class="text-3xl mb-2">&#127858;</p>
                    <p class="text-sm text-sage-400">{{ __('No food logged on this day') }}</p>
                </div>
            @endif
        </div>

        {{-- Activities --}}
        <div class="bg-white rounded-2xl border border-sage-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-sage-100 flex items-center gap-3">
                <span class="text-xl">&#127939;</span>
                <h3 class="font-bold text-forest-700">{{ __('Activities') }}</h3>
                <span class="text-xs text-sage-400 ml-auto">{{ $activities->count() }} {{ __('items') }} &bull; {{ $activityTotals->minutes }} min</span>
            </div>

            @if ($activities->count() > 0)
                <div class="divide-y divide-sage-50">
                    @foreach ($activities as $act)
                        <div class="px-6 py-4 flex items-center gap-4">
                            <div class="w-14 h-14 rounded-2xl bg-orange-100 flex items-center justify-center text-2xl shrink-0">&#127939;</div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between gap-2">
                                    <div>
                                        <p class="font-semibold text-forest-700 capitalize">{{ str_replace('_', ' ', $act->activity_type) }}</p>
                                        <p class="text-xs text-sage-500">{{ $act->duration_minutes }} {{ __('menit') }}</p>
                                    </div>
                                    <p class="font-bold text-orange-600 shrink-0">{{ $act->calories_burned }} kcal</p>
                                </div>
                                @if ($act->distance_km)
                                    <div class="flex gap-4 mt-1 text-xs">
                                        <span class="text-sage-500">&#128207; {{ number_format($act->distance_km, 2) }} km</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="px-6 py-10 text-center">
                    <p class="text-3xl mb-2">&#127939;</p>
                    <p class="text-sm text-sage-400">{{ __('No activities logged on this day') }}</p>
                </div>
            @endif
        </div>

        {{-- Navigation --}}
        <div class="flex justify-between">
            <a href="{{ route('report', ['date' => \Carbon\Carbon::parse($date)->subDay()->toDateString()]) }}" class="btn-secondary px-6 py-3">&larr; {{ __('Yesterday') }}</a>
            <a href="{{ route('history') }}" class="px-6 py-3 rounded-2xl text-sm font-semibold bg-sage-100 text-sage-700 hover:bg-sage-200 transition-colors">&#128214; {{ __('Back to History') }}</a>
            <a href="{{ route('report', ['date' => \Carbon\Carbon::parse($date)->addDay()->toDateString()]) }}" class="btn-secondary px-6 py-3">{{ __('Tomorrow') }} &rarr;</a>
        </div>
    </div>
</x-app-layout>
