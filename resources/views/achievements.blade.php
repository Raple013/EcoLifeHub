<x-app-layout>
    <div class="max-w-5xl mx-auto py-10 px-4 space-y-8">

        <div>
            <p class="text-xs text-muted font-medium uppercase tracking-[0.2em] mb-3">{{ __('Progress') }}</p>
            <h1 class="font-serif text-4xl md:text-5xl text-ink">{{ __('Achievements') }}</h1>
            <p class="text-muted mt-2">{{ $userAchievements->count() }} of {{ $allAchievements->count() }} {{ __('earned') }}</p>
        </div>

        <div class="space-y-4">
            @foreach ($allAchievements as $ach)
                @php $earned = $userAchievements->firstWhere('id', $ach->id); @endphp
                <div class="card p-6 md:p-8 flex items-start gap-6 {{ $earned ? '' : 'opacity-50' }}">
                    <div class="shrink-0 w-16 h-16 rounded-full border-3 flex items-center justify-center text-xl font-bold {{ $earned ? $ach->color_class : 'border-sage-200 bg-white text-sage-300' }}"
                         style="border-width: 3px;">
                        {{ $ach->level }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-3 flex-wrap">
                            <h2 class="font-serif text-xl text-ink {{ $earned ? '' : 'text-sage-400' }}">{{ $ach->name }}</h2>
                            @if ($earned)
                                <span class="px-2.5 py-0.5 text-[10px] font-semibold tracking-wide rounded-full {{ $ach->color_class }}">
                                    {{ __('Earned') }}
                                </span>
                            @else
                                <span class="px-2.5 py-0.5 text-[10px] font-semibold tracking-wide rounded-full bg-sage-100 text-sage-400">
                                    {{ __('Locked') }}
                                </span>
                            @endif
                        </div>
                        <p class="text-sm text-muted mt-1">{{ $ach->description }}</p>
                        @if ($earned)
                            <p class="text-xs text-muted/60 mt-2">
                                {{ __('Earned') }} {{ \Carbon\Carbon::parse($earned->pivot->earned_at)->diffForHumans() }}
                            </p>
                        @else
                            <p class="text-xs text-sage-300 mt-2">
                                @switch($ach->level)
                                    @case(1) {{ __('Join EcoLife Hub to unlock') }} @break
                                    @case(2) {{ __('Reach 50 minutes of total activity') }} @break
                                    @case(3) {{ __('Reach 200 minutes of activity or score 80+ on quiz') }} @break
                                    @case(4) {{ __('Score 90 or higher on the quiz') }} @break
                                    @case(5) {{ __('Reach 500 minutes of activity and score 90+ on quiz') }} @break
                                @endswitch
                            </p>
                        @endif
                    </div>
                    @if ($earned)
                        <svg class="shrink-0 w-6 h-6 text-forest-500 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    @endif
                </div>
            @endforeach
        </div>

    </div>
</x-app-layout>
