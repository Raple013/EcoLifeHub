<x-app-layout>
    <div class="max-w-4xl mx-auto py-10 px-4 space-y-8">

        {{-- Header --}}
        <div class="text-center">
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-orange-100 text-orange-700 mb-4">
                &#127858; {{ __('Nutrition Tracker') }}
            </span>
            <h1 class="font-display text-4xl text-forest-800">{{ __('🥗 What did you eat today?') }}</h1>
            <p class="text-sage-500 mt-2">{{ __('Snap a photo or search to log your meals') }}</p>
        </div>

        {{-- Action Buttons --}}
        <div class="flex flex-wrap gap-4 justify-center">
            @if ($hasGeminiKey)
                <button onclick="openScanModal()" class="btn-primary text-base py-3.5 px-8">
                    <span>&#128247;</span> {{ __('Scan with Photo') }}
                </button>
            @endif
            <button onclick="openSearchModal()" class="btn-primary text-base py-3.5 px-8" style="background:#059669">
                <span>&#128270;</span> {{ __('Search Food') }}
            </button>
            <button onclick="openManualModal()" class="px-8 py-3.5 rounded-2xl text-sm font-semibold bg-sage-100 text-sage-700 hover:bg-sage-200 transition-colors">
                <span>&#9998;</span> {{ __('Input Manually') }}
            </button>
            <a href="{{ route('nutrition.history') }}" class="px-8 py-3.5 rounded-2xl text-sm font-semibold bg-forest-100 text-forest-700 hover:bg-forest-200 transition-colors">
                <span>&#128214;</span> {{ __('View History') }}
            </a>
        </div>

        {{-- Today's Summary --}}
        <div class="bg-white rounded-2xl border border-sage-200 p-6">
            <h2 class="font-bold text-forest-700 mb-4">&#128200; {{ __("Today's Nutrition Summary") }}</h2>
            <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                <div class="text-center">
                    <p class="text-2xl font-bold text-orange-600">{{ number_format($totals->calories) }}</p>
                    <p class="text-xs text-sage-500">{{ __('Calories') }} (kcal)</p>
                </div>
                <div class="text-center">
                    <p class="text-2xl font-bold text-blue-600">{{ number_format($totals->protein_g, 1) }}g</p>
                    <p class="text-xs text-sage-500">{{ __('Protein') }}</p>
                </div>
                <div class="text-center">
                    <p class="text-2xl font-bold text-amber-600">{{ number_format($totals->carbs_g, 1) }}g</p>
                    <p class="text-xs text-sage-500">{{ __('Carbs') }}</p>
                </div>
                <div class="text-center">
                    <p class="text-2xl font-bold text-rose-600">{{ number_format($totals->sugar_g, 1) }}g</p>
                    <p class="text-xs text-sage-500">{{ __('Sugar') }}</p>
                </div>
                <div class="text-center">
                    <p class="text-2xl font-bold text-purple-600">{{ number_format($totals->fat_g, 1) }}g</p>
                    <p class="text-xs text-sage-500">{{ __('Fat') }}</p>
                </div>
            </div>
        </div>

        {{-- Progress Bars --}}
        @php
            $targets = ['calories' => 2000, 'protein_g' => 60, 'carbs_g' => 250, 'sugar_g' => 50, 'fat_g' => 65];
            $colors = ['calories' => 'orange', 'protein_g' => 'blue', 'carbs_g' => 'amber', 'sugar_g' => 'rose', 'fat_g' => 'purple'];
        @endphp
        <div class="bg-white rounded-2xl border border-sage-200 p-6 space-y-3">
            @foreach (['calories' => 'Calories (kcal)', 'protein_g' => 'Protein (g)', 'carbs_g' => 'Carbs (g)', 'sugar_g' => 'Sugar (g)', 'fat_g' => 'Fat (g)'] as $key => $label)
                @php
                    $pct = min(($totals->$key / $targets[$key]) * 100, 100);
                    $color = $colors[$key];
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

        {{-- Today's Log by Meal Type --}}
            @php
                $mealIcons = ['makanan_berat' => '&#127858;', 'minuman' => '&#129347;', 'snack' => '&#127851;'];
                $mealLabels = ['makanan_berat' => 'Makanan Berat', 'minuman' => 'Minuman', 'snack' => 'Snack'];
            @endphp

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach (['makanan_berat', 'minuman', 'snack'] as $type)
                <div class="bg-white rounded-2xl border border-sage-200 overflow-hidden">
                    <div class="px-5 py-3 border-b border-sage-100 flex items-center justify-between">
                        <h3 class="font-bold text-forest-700">{!! $mealIcons[$type] !!} {{ __($mealLabels[$type]) }}</h3>
                        <span class="text-xs text-sage-400">{{ $grouped[$type]->count() }} items</span>
                    </div>
                    <div class="divide-y divide-sage-50">
                        @forelse ($grouped[$type] as $log)
                            <div class="px-5 py-3 flex items-start gap-3 group">
                                @if ($log->image_url)
                                    <img src="{{ Storage::url($log->image_url) }}" class="w-10 h-10 rounded-xl object-cover shrink-0">
                                @else
                                    <div class="w-10 h-10 rounded-xl bg-sage-100 flex items-center justify-center text-lg shrink-0">&#127858;</div>
                                @endif
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-forest-700 truncate">{{ $log->food_name }}</p>
                                    <p class="text-xs text-sage-400">
                                        {{ number_format($log->calories) }} kcal
                                        @if ($log->protein_g > 0) &bull; P: {{ number_format($log->protein_g, 1) }}g @endif
                                        @if ($log->carbs_g > 0) &bull; C: {{ number_format($log->carbs_g, 1) }}g @endif
                                        @if ($log->fat_g > 0) &bull; F: {{ number_format($log->fat_g, 1) }}g @endif
                                    </p>
                                </div>
                                <form action="{{ route('nutrition.destroy', $log) }}" method="POST" onsubmit="return confirm('{{ __('Delete this entry?') }}')">
                                    @csrf @method('DELETE')
                                    <button class="text-sage-300 hover:text-red-500 transition-colors opacity-0 group-hover:opacity-100 text-sm">&times;</button>
                                </form>
                            </div>
                        @empty
                            <p class="px-5 py-6 text-center text-sm text-sage-400">{{ __('No items logged') }}</p>
                        @endforelse
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Scan Modal --}}
    <div id="scanModal" class="fixed inset-0 z-50 hidden bg-black/50 overflow-y-auto py-10" onclick="if(event.target===this)closeScanModal()">
        <div class="bg-white rounded-3xl p-6 w-full max-w-lg mx-auto my-10" onclick="event.stopPropagation()">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-bold text-forest-700 text-lg">&#128247; {{ __('Scan Food') }}</h3>
                <button onclick="closeScanModal()" class="text-sage-400 hover:text-sage-600 text-xl">&times;</button>
            </div>

            <div id="scanStep1">
                <form id="scanForm" class="space-y-4">
                    @csrf
                    <div>
                        <label class="input-label">{{ __('Meal Type') }}</label>
                        <select name="meal_type" id="scan_meal_type" class="input-field" required>
                            <option value="makanan_berat">{{ __('Makanan Berat') }}</option>
                            <option value="minuman">{{ __('Minuman') }}</option>
                            <option value="snack" selected>{{ __('Snack') }}</option>
                        </select>
                    </div>
                    <div>
                        <label class="input-label">{{ __('Photo') }}</label>
                        <input type="file" name="image" id="scanImage" accept="image/jpeg,image/png" class="input-field text-sm py-2" required>
                        <p class="text-xs text-sage-400 mt-1">{{ __('Take a photo of your food or drink') }}</p>
                    </div>
                    <button type="submit" id="scanBtn" class="btn-primary w-full justify-center py-3">
                        &#128247; {{ __('Analyze Food') }}
                    </button>
                </form>
            </div>

            <div id="scanStep2" class="hidden space-y-4">
                <div class="flex items-center justify-center py-8">
                    <div class="animate-spin w-10 h-10 border-4 border-forest-600 border-t-transparent rounded-full"></div>
                </div>
                <p class="text-center text-sage-500 text-sm">{{ __('Analyzing your food with AI...') }}</p>
            </div>

            <div id="scanStep3" class="hidden space-y-4">
                <div id="scanPreview" class="flex items-center gap-3 p-4 bg-sage-50 rounded-2xl">
                    <img id="scanPreviewImg" class="w-16 h-16 rounded-xl object-cover">
                    <div>
                        <p id="scanResultName" class="font-bold text-forest-700"></p>
                        <p id="scanResultServing" class="text-xs text-sage-400"></p>
                    </div>
                </div>
                <form id="confirmForm" action="{{ route('nutrition.confirm') }}" method="POST" class="space-y-3">
                    @csrf
                    <input type="hidden" name="source" value="ai_vision">
                    <input type="hidden" name="image_url" id="confirm_image_url">
                    <input type="hidden" name="meal_type" id="confirm_meal_type">
                    <div>
                        <label class="input-label">{{ __('Food Name') }}</label>
                        <input type="text" name="food_name" id="confirm_food_name" class="input-field" required>
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div><label class="input-label">{{ __('Calories') }} (kcal)</label><input type="number" name="calories" id="confirm_calories" step="0.1" class="input-field" required></div>
                        <div><label class="input-label">{{ __('Protein') }} (g)</label><input type="number" name="protein_g" id="confirm_protein" step="0.1" class="input-field"></div>
                        <div><label class="input-label">{{ __('Carbs') }} (g)</label><input type="number" name="carbs_g" id="confirm_carbs" step="0.1" class="input-field"></div>
                        <div><label class="input-label">{{ __('Sugar') }} (g)</label><input type="number" name="sugar_g" id="confirm_sugar" step="0.1" class="input-field"></div>
                        <div class="col-span-2"><label class="input-label">{{ __('Fat') }} (g)</label><input type="number" name="fat_g" id="confirm_fat" step="0.1" class="input-field"></div>
                    </div>
                    <button type="submit" class="btn-primary w-full justify-center py-3">&#10003; {{ __('Save Entry') }}</button>
                </form>
            </div>
        </div>
    </div>

    {{-- Search Modal --}}
    <div id="searchModal" class="fixed inset-0 z-50 hidden bg-black/50 overflow-y-auto py-10" onclick="if(event.target===this)closeSearchModal()">
        <div class="bg-white rounded-3xl p-6 w-full max-w-lg mx-auto my-10" onclick="event.stopPropagation()">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-bold text-forest-700 text-lg">&#128270; {{ __('Search Food Database') }}</h3>
                <button onclick="closeSearchModal()" class="text-sage-400 hover:text-sage-600 text-xl">&times;</button>
            </div>

            <div class="space-y-3">
                <div class="flex gap-2">
                    <input type="text" id="searchQuery" class="input-field flex-1" placeholder="{{ __('Search food...') }}" autocomplete="off">
                    <button onclick="searchFood()" class="px-4 py-2 bg-forest-600 text-white rounded-xl text-sm font-medium hover:bg-forest-700 transition-colors">{{ __('Search') }}</button>
                </div>
                <div>
                    <label class="input-label">{{ __('Meal Type') }}</label>
                    <select id="search_meal_type" class="input-field">
                        <option value="makanan_berat">{{ __('Makanan Berat') }}</option>
                        <option value="minuman">{{ __('Minuman') }}</option>
                        <option value="snack" selected>{{ __('Snack') }}</option>
                    </select>
                </div>
                <div id="searchResults" class="space-y-2"></div>
            </div>
        </div>
    </div>

    {{-- Manual Modal --}}
    <div id="manualModal" class="fixed inset-0 z-50 hidden bg-black/50 overflow-y-auto py-10" onclick="if(event.target===this)closeManualModal()">
        <div class="bg-white rounded-3xl p-6 w-full max-w-md mx-auto my-10" onclick="event.stopPropagation()">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-bold text-forest-700 text-lg">&#9998; {{ __('Manual Input') }}</h3>
                <button onclick="closeManualModal()" class="text-sage-400 hover:text-sage-600 text-xl">&times;</button>
            </div>
            <form action="{{ route('nutrition.manual') }}" method="POST" class="space-y-3">
                @csrf
                <div>
                    <label class="input-label">{{ __('Food Name') }}</label>
                    <input type="text" name="food_name" class="input-field" required>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="input-label">{{ __('Meal Type') }}</label>
                        <select name="meal_type" class="input-field">
                            <option value="makanan_berat">{{ __('Makanan Berat') }}</option>
                            <option value="minuman">{{ __('Minuman') }}</option>
                            <option value="snack" selected>{{ __('Snack') }}</option>
                        </select>
                    </div>
                    <div>
                        <label class="input-label">{{ __('Calories') }} (kcal)</label>
                        <input type="number" name="calories" step="0.1" class="input-field" required>
                    </div>
                    <div><label class="input-label">{{ __('Protein') }} (g)</label><input type="number" name="protein_g" step="0.1" class="input-field"></div>
                    <div><label class="input-label">{{ __('Carbs') }} (g)</label><input type="number" name="carbs_g" step="0.1" class="input-field"></div>
                    <div><label class="input-label">{{ __('Sugar') }} (g)</label><input type="number" name="sugar_g" step="0.1" class="input-field"></div>
                    <div><label class="input-label">{{ __('Fat') }} (g)</label><input type="number" name="fat_g" step="0.1" class="input-field"></div>
                </div>
                <button type="submit" class="btn-primary w-full justify-center py-3">&#10003; {{ __('Save') }}</button>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        // ==================== SCAN ====================
        const scanModal = document.getElementById('scanModal');
        const scanStep1 = document.getElementById('scanStep1');
        const scanStep2 = document.getElementById('scanStep2');
        const scanStep3 = document.getElementById('scanStep3');
        const scanForm = document.getElementById('scanForm');
        const scanBtn = document.getElementById('scanBtn');

        function openScanModal() { scanModal.classList.remove('hidden'); scanStep1.classList.remove('hidden'); scanStep2.classList.add('hidden'); scanStep3.classList.add('hidden'); scanForm.reset(); }
        function closeScanModal() { scanModal.classList.add('hidden'); }

        scanForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            scanStep1.classList.add('hidden');
            scanStep2.classList.remove('hidden');

            const formData = new FormData(this);

            try {
                const res = await fetch('{{ route('nutrition.scan') }}', { method: 'POST', body: formData });
                const data = await res.json();

                if (!res.ok) {
                    alert('Gemini: ' + (data.error || '{{ __('Analysis failed') }}'));
                    scanStep2.classList.add('hidden');
                    scanStep1.classList.remove('hidden');
                    return;
                }

                document.getElementById('scanPreviewImg').src = URL.createObjectURL(formData.get('image'));
                document.getElementById('scanResultName').textContent = data.food_name;
                document.getElementById('scanResultServing').textContent = data.serving_size;
                document.getElementById('confirm_food_name').value = data.food_name;
                document.getElementById('confirm_calories').value = data.calories;
                document.getElementById('confirm_protein').value = data.protein_g;
                document.getElementById('confirm_carbs').value = data.carbs_g;
                document.getElementById('confirm_sugar').value = data.sugar_g;
                document.getElementById('confirm_fat').value = data.fat_g;
                document.getElementById('confirm_image_url').value = data.image_url;
                document.getElementById('confirm_meal_type').value = data.meal_type;

                scanStep2.classList.add('hidden');
                scanStep3.classList.remove('hidden');
            } catch (err) {
                alert('{{ __('Connection error') }}');
                scanStep2.classList.add('hidden');
                scanStep1.classList.remove('hidden');
            }
        });

        // ==================== SEARCH ====================
        const searchModal = document.getElementById('searchModal');

        function openSearchModal() { searchModal.classList.remove('hidden'); document.getElementById('searchResults').innerHTML = ''; document.getElementById('searchQuery').value = ''; }
        function closeSearchModal() { searchModal.classList.add('hidden'); }

        async function searchFood() {
            const q = document.getElementById('searchQuery').value.trim();
            if (!q) return;
            const el = document.getElementById('searchResults');
            el.innerHTML = '<p class="text-center text-sage-400 text-sm py-4">{{ __('Searching...') }}</p>';

            try {
                const res = await fetch('{{ route('nutrition.search') }}?q=' + encodeURIComponent(q));
                const data = await res.json();
                const results = data.results || [];
                if (!results.length) {
                    el.innerHTML = '<p class="text-center text-sage-400 text-sm py-4">{{ __('No results found. Try manual input.') }}</p>';
                    return;
                }
                const sourceLabel = data.source === 'ai_estimated' ? '<span class="text-xs text-purple-500 font-medium">&#9889; AI Estimated</span>' : '';
                el.innerHTML = results.map(f => `
                    <div class="p-3 rounded-xl border border-sage-100 hover:border-forest-300 cursor-pointer transition-colors" onclick="selectFood('${f.food_name.replace(/'/g, "\\'")}', ${f.calories}, ${f.protein_g}, ${f.carbs_g}, ${f.sugar_g}, ${f.fat_g}, '${data.source}')">
                        <p class="text-sm font-medium text-forest-700">${f.food_name} ${sourceLabel}</p>
                        <p class="text-xs text-sage-400">${f.calories} kcal &bull; P: ${f.protein_g}g &bull; C: ${f.carbs_g}g &bull; F: ${f.fat_g}g${f.serving_size ? ' &bull; ' + f.serving_size : ''}</p>
                    </div>
                `).join('');
            } catch (err) {
                el.innerHTML = '<p class="text-center text-red-500 text-sm py-4">{{ __('Search failed') }}</p>';
            }
        }

        document.getElementById('searchQuery').addEventListener('keydown', function(e) { if (e.key === 'Enter') searchFood(); });

        function selectFood(name, cal, protein, carbs, sugar, fat, source) {
            const mealType = document.getElementById('search_meal_type').value;
            const token = document.querySelector('meta[name="csrf-token"]')?.content;

            fetch('{{ route('nutrition.confirm') }}', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded', 'Accept': 'application/json', 'X-CSRF-TOKEN': token },
                body: new URLSearchParams({
                    _token: token,
                    food_name: name,
                    calories: cal,
                    protein_g: protein,
                    carbs_g: carbs,
                    sugar_g: sugar,
                    fat_g: fat,
                    meal_type: mealType,
                    source: source || 'manual_search',
                })
            }).then(async res => {
                const json = await res.json().catch(() => ({}));
                if (!res.ok) {
                    alert('Error: ' + (json.error || json.message || '{{ __('Failed to save') }}'));
                    return;
                }
                window.location.href = json.redirect || '{{ route('nutrition.history') }}';
            }).catch(err => {
                alert('{{ __('Connection error') }}: ' + err.message);
            });
        }

        // ==================== MANUAL ====================
        function openManualModal() { document.getElementById('manualModal').classList.remove('hidden'); }
        function closeManualModal() { document.getElementById('manualModal').classList.add('hidden'); }
    </script>
    @endpush
</x-app-layout>
