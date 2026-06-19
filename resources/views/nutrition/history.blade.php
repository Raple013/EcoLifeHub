<x-app-layout>
    <x-slot name="header">
        <h2 class="font-display text-2xl text-forest-800">&#128214; {{ __('Nutrition History') }}</h2>
    </x-slot>

    <div class="max-w-5xl mx-auto py-8 px-4 space-y-6">
        {{-- Filters --}}
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('nutrition.history') }}" class="px-4 py-2 rounded-xl text-sm font-medium transition-colors {{ !request('period') && !request('date') ? 'bg-forest-600 text-white' : 'bg-sage-100 text-sage-700 hover:bg-sage-200' }}">
                {{ __('All') }}
            </a>
            <a href="{{ route('nutrition.history', ['period' => 'today']) }}" class="px-4 py-2 rounded-xl text-sm font-medium transition-colors {{ request('period') === 'today' ? 'bg-forest-600 text-white' : 'bg-sage-100 text-sage-700 hover:bg-sage-200' }}">
                {{ __('Today') }}
            </a>
            <a href="{{ route('nutrition.history', ['period' => 'week']) }}" class="px-4 py-2 rounded-xl text-sm font-medium transition-colors {{ request('period') === 'week' ? 'bg-forest-600 text-white' : 'bg-sage-100 text-sage-700 hover:bg-sage-200' }}">
                {{ __('This Week') }}
            </a>
            <a href="{{ route('nutrition.history', ['period' => 'month']) }}" class="px-4 py-2 rounded-xl text-sm font-medium transition-colors {{ request('period') === 'month' ? 'bg-forest-600 text-white' : 'bg-sage-100 text-sage-700 hover:bg-sage-200' }}">
                {{ __('This Month') }}
            </a>
        </div>

        {{-- Summary --}}
        @if ($logs->count() > 0)
            <div class="bg-white rounded-2xl border border-sage-200 p-6">
                <h3 class="font-bold text-forest-700 mb-4">&#128200; {{ __('Period Summary') }}</h3>
                <div class="grid grid-cols-2 md:grid-cols-5 gap-4 text-center">
                    <div>
                        <p class="text-2xl font-bold text-orange-600">{{ number_format($totals->calories) }}</p>
                        <p class="text-xs text-sage-500">{{ __('Calories') }} (kcal)</p>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-blue-600">{{ number_format($totals->protein_g, 1) }}g</p>
                        <p class="text-xs text-sage-500">{{ __('Protein') }}</p>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-amber-600">{{ number_format($totals->carbs_g, 1) }}g</p>
                        <p class="text-xs text-sage-500">{{ __('Carbs') }}</p>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-rose-600">{{ number_format($totals->sugar_g, 1) }}g</p>
                        <p class="text-xs text-sage-500">{{ __('Sugar') }}</p>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-purple-600">{{ number_format($totals->fat_g, 1) }}g</p>
                        <p class="text-xs text-sage-500">{{ __('Fat') }}</p>
                    </div>
                </div>
            </div>

            @php
                $targets = ['calories' => 2000, 'protein_g' => 60, 'carbs_g' => 250, 'sugar_g' => 50, 'fat_g' => 65];
                $pcolors = ['calories' => 'orange', 'protein_g' => 'blue', 'carbs_g' => 'amber', 'sugar_g' => 'rose', 'fat_g' => 'purple'];
            @endphp
            <div class="bg-white rounded-2xl border border-sage-200 p-6 space-y-3">
                @foreach (['calories' => 'Calories (kcal)', 'protein_g' => 'Protein (g)', 'carbs_g' => 'Carbs (g)', 'sugar_g' => 'Sugar (g)', 'fat_g' => 'Fat (g)'] as $key => $label)
                    @php
                        $pct = min(($totals->$key / $targets[$key]) * 100, 100);
                        $color = $pcolors[$key];
                    @endphp
                    <div>
                        <div class="flex justify-between text-sm text-sage-600 mb-1">
                            <span>{{ __($label) }}</span>
                            <span class="font-medium">{{ number_format($totals->$key, 1) }} / {{ $targets[$key] }}</span>
                        </div>
                        <div class="progress-bar h-3">
                            <div class="progress-fill bg-{{ $color }}-500" style="width: {{ $pct }}%"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- Entries by Date --}}
        @php
            $groupedByDate = collect($logs->items())->groupBy(fn($l) => $l->logged_at->toDateString());
        @endphp

        @forelse ($groupedByDate as $date => $entries)
            <div class="bg-white rounded-2xl border border-sage-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-sage-100 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-forest-100 flex items-center justify-center text-sm font-bold text-forest-700">
                        {{ \Carbon\Carbon::parse($date)->format('d') }}
                    </div>
                    <div>
                        <p class="font-bold text-forest-700">{{ \Carbon\Carbon::parse($date)->locale(app()->getLocale())->diffForHumans() }}</p>
                        <p class="text-xs text-sage-400">{{ $entries->sum('calories') }} kcal &bull; {{ $entries->count() }} items</p>
                    </div>
                </div>
                <div class="divide-y divide-sage-50">
                    @foreach ($entries as $log)
                        <div class="px-6 py-3 flex items-start gap-3 group cursor-pointer hover:bg-sage-50 transition-colors" onclick="showDetail({{ $log->id }})">
                            @if ($log->image_url)
                                <img src="{{ Storage::url($log->image_url) }}" class="w-10 h-10 rounded-xl object-cover shrink-0">
                            @else
                                <div class="w-10 h-10 rounded-xl bg-sage-100 flex items-center justify-center text-lg shrink-0">&#127858;</div>
                            @endif
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-forest-700 truncate">{{ $log->food_name }}</p>
                                <p class="text-xs text-sage-400">
                                    {{ $log->meal_type === 'makanan_berat' ? __('Makanan Berat') : ($log->meal_type === 'minuman' ? __('Minuman') : __('Snack')) }} &bull; {{ number_format($log->calories) }} kcal
                                    @if ($log->protein_g > 0) &bull; P: {{ number_format($log->protein_g, 1) }}g @endif
                                    @if ($log->carbs_g > 0) &bull; C: {{ number_format($log->carbs_g, 1) }}g @endif
                                    @if ($log->fat_g > 0) &bull; F: {{ number_format($log->fat_g, 1) }}g @endif
                                </p>
                            </div>
                            <form action="{{ route('nutrition.destroy', $log) }}" method="POST" onsubmit="return confirm('{{ __('Delete this entry?') }}')" onclick="event.stopPropagation()">
                                @csrf @method('DELETE')
                                <button class="text-sage-300 hover:text-red-500 transition-colors opacity-0 group-hover:opacity-100 text-sm">&times;</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        @empty
            <div class="card p-12 text-center">
                <p class="text-5xl mb-4">&#127858;</p>
                <h3 class="font-display text-2xl text-forest-800 mb-2">{{ __('No entries found') }}</h3>
                <p class="text-sage-500">{{ __('Start logging your meals to see history.') }}</p>
                <a href="{{ route('nutrition.index') }}" class="btn-primary mt-6">&#127858; {{ __('Log Food') }}</a>
            </div>
        @endforelse

        <div class="py-4">
            {{ $logs->links() }}
        </div>
    </div>

    {{-- Detail Modal --}}
    <div id="detailModal" class="fixed inset-0 z-50 hidden bg-black/50 overflow-y-auto py-10" onclick="if(event.target===this)closeDetail()">
        <div class="bg-white rounded-3xl p-6 w-full max-w-md mx-auto my-10" onclick="event.stopPropagation()">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-bold text-forest-700 text-lg" id="detailTitle">&#128270; {{ __('Detail') }}</h3>
                <button onclick="closeDetail()" class="text-sage-400 hover:text-sage-600 text-xl">&times;</button>
            </div>
            <div id="detailContent" class="space-y-4">
                <div class="flex items-center gap-4">
                    <div id="detailImage" class="w-20 h-20 rounded-2xl bg-sage-100 flex items-center justify-center text-3xl shrink-0">&#127858;</div>
                    <div>
                        <p id="detailFoodName" class="font-bold text-forest-700 text-lg"></p>
                        <p id="detailMealType" class="text-xs text-sage-500"></p>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div class="bg-orange-50 rounded-2xl p-4 text-center border border-orange-100">
                        <p class="text-xs text-sage-500">{{ __('Calories') }}</p>
                        <p id="detailCalories" class="text-xl font-bold text-orange-600"></p>
                    </div>
                    <div class="bg-blue-50 rounded-2xl p-4 text-center border border-blue-100">
                        <p class="text-xs text-sage-500">{{ __('Protein') }}</p>
                        <p id="detailProtein" class="text-xl font-bold text-blue-600"></p>
                    </div>
                    <div class="bg-amber-50 rounded-2xl p-4 text-center border border-amber-100">
                        <p class="text-xs text-sage-500">{{ __('Carbs') }}</p>
                        <p id="detailCarbs" class="text-xl font-bold text-amber-600"></p>
                    </div>
                    <div class="bg-purple-50 rounded-2xl p-4 text-center border border-purple-100">
                        <p class="text-xs text-sage-500">{{ __('Fat') }}</p>
                        <p id="detailFat" class="text-xl font-bold text-purple-600"></p>
                    </div>
                    <div class="bg-rose-50 rounded-2xl p-4 text-center border border-rose-100">
                        <p class="text-xs text-sage-500">{{ __('Sugar') }}</p>
                        <p id="detailSugar" class="text-xl font-bold text-rose-600"></p>
                    </div>
                    <div class="bg-sage-50 rounded-2xl p-4 text-center border border-sage-100">
                        <p class="text-xs text-sage-500">{{ __('Source') }}</p>
                        <p id="detailSource" class="text-xl font-bold text-sage-600 text-sm"></p>
                    </div>
                </div>
                <p id="detailTime" class="text-xs text-sage-400 text-center"></p>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        const logs = @json($logs->items());
        const storageBase = (() => { let u = '{{ Storage::url('') }}'; return u.endsWith('/') ? u : u + '/'; })();

        function showDetail(id) {
            const log = logs.find(l => l.id === id);
            if (!log) return;

            document.getElementById('detailFoodName').textContent = log.food_name;
            document.getElementById('detailMealType').textContent = log.meal_type === 'makanan_berat' ? '{{ __('Makanan Berat') }}' : log.meal_type === 'minuman' ? '{{ __('Minuman') }}' : '{{ __('Snack') }}';
            document.getElementById('detailCalories').textContent = Number(log.calories).toLocaleString() + ' kcal';
            document.getElementById('detailProtein').textContent = Number(log.protein_g).toFixed(1) + 'g';
            document.getElementById('detailCarbs').textContent = Number(log.carbs_g).toFixed(1) + 'g';
            document.getElementById('detailFat').textContent = Number(log.fat_g).toFixed(1) + 'g';
            document.getElementById('detailSugar').textContent = Number(log.sugar_g).toFixed(1) + 'g';
            document.getElementById('detailSource').textContent = log.source || '-';
            document.getElementById('detailTime').textContent = '{{ __('Logged at') }}: ' + new Date(log.logged_at).toLocaleString();

            const imgEl = document.getElementById('detailImage');
            if (log.image_url) {
                imgEl.innerHTML = '<img src="' + storageBase + log.image_url + '" class="w-20 h-20 rounded-2xl object-cover">';
                imgEl.className = 'w-20 h-20 rounded-2xl shrink-0';
            } else {
                imgEl.innerHTML = '&#127858;';
                imgEl.className = 'w-20 h-20 rounded-2xl bg-sage-100 flex items-center justify-center text-3xl shrink-0';
            }

            document.getElementById('detailModal').classList.remove('hidden');
        }

        function closeDetail() {
            document.getElementById('detailModal').classList.add('hidden');
        }
    </script>
    @endpush
</x-app-layout>
