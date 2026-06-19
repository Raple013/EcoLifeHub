<x-guest-layout>
    <div class="text-center mb-6">
        <p class="text-4xl mb-2">&#127793;</p>
        <h1 class="font-display text-2xl text-forest-800">{{ __('Tell Us About Yourself') }}</h1>
        <p class="text-sage-500 text-sm mt-1">{{ __('We need your body metrics for accurate calorie & health tracking') }}</p>
    </div>

    <form method="POST" action="{{ route('body-data.store') }}" class="space-y-5">
        @csrf

        <div>
            <label for="weight_kg" class="label">{{ __('Weight') }} <span class="text-sage-400 font-normal">(kg)</span></label>
            <div class="relative">
                <input id="weight_kg" type="number" name="weight_kg" step="0.1" min="20" max="300" class="input-field pl-10" placeholder="e.g. 70" value="{{ old('weight_kg', auth()->user()->weight_kg) }}" required>
                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-lg">&#9878;</span>
            </div>
            <x-input-error :messages="$errors->get('weight_kg')" class="mt-2" />
        </div>

        <div>
            <label for="height_cm" class="label">{{ __('Height') }} <span class="text-sage-400 font-normal">(cm)</span></label>
            <div class="relative">
                <input id="height_cm" type="number" name="height_cm" min="80" max="250" class="input-field pl-10" placeholder="e.g. 170" value="{{ old('height_cm', auth()->user()->height_cm) }}" required>
                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-lg">&#128218;</span>
            </div>
            <x-input-error :messages="$errors->get('height_cm')" class="mt-2" />
        </div>

        {{-- BMI Result --}}
        <div id="bmi_result" class="hidden">
            <div class="rounded-2xl p-5 border" id="bmi_card">
                <div class="flex items-center justify-between mb-3">
                    <span class="font-semibold text-forest-700">{{ __('Your BMI') }}</span>
                    <span id="bmi_emoji" class="text-2xl"></span>
                </div>
                <div class="flex items-baseline gap-2">
                    <span class="font-display text-4xl" id="bmi_value">0</span>
                    <span class="text-sage-500 text-lg">{{ __('kg/m²') }}</span>
                </div>
                <span id="bmi_status" class="inline-block mt-2 px-3 py-1 rounded-full text-sm font-medium border"></span>
                <p id="bmi_summary" class="text-xs text-sage-500 mt-3 leading-relaxed"></p>
            </div>
        </div>

        <button type="submit" class="btn-primary w-full justify-center py-3.5">
            {{ __('Save & Continue') }}
        </button>

        <a href="{{ route('dashboard') }}" class="block text-center text-sm text-sage-400 hover:text-sage-600 transition-colors">
            {{ __("Skip for now — I'll fill it later") }}
        </a>
    </form>

    @push('scripts')
    <script>
        const weightInput = document.getElementById('weight_kg');
        const heightInput = document.getElementById('height_cm');
        const bmiResult = document.getElementById('bmi_result');
        const bmiValue = document.getElementById('bmi_value');
        const bmiStatus = document.getElementById('bmi_status');
        const bmiEmoji = document.getElementById('bmi_emoji');
        const bmiCard = document.getElementById('bmi_card');
        const bmiSummary = document.getElementById('bmi_summary');

        function calculateBMI() {
            const weight = parseFloat(weightInput.value);
            const height = parseInt(heightInput.value);

            if (!weight || !height || height <= 0) {
                bmiResult.classList.add('hidden');
                return;
            }

            const heightM = height / 100;
            const bmi = weight / (heightM * heightM);
            const rounded = Math.round(bmi * 10) / 10;

            let status, cls, emoji, summary;

            if (bmi < 18.5) {
                status = 'Kurus';
                cls = 'bg-blue-100 text-blue-700 border-blue-200';
                emoji = '&#128564;';
                summary = 'Kamu mungkin perlu menambah berat badan. Fokus pada makanan bergizi dan latihan kekuatan.';
            } else if (bmi < 23) {
                status = 'Normal (Ideal)';
                cls = 'bg-green-100 text-green-700 border-green-200';
                emoji = '&#128170;';
                summary = 'Bagus! Berat badanmu dalam kisaran sehat. Pertahankan gaya hidupmu.';
            } else if (bmi < 25) {
                status = 'Kelebihan Berat';
                cls = 'bg-yellow-100 text-yellow-700 border-yellow-200';
                emoji = '&#9888;';
                summary = 'Kamu sedikit di atas kisaran ideal. Pertimbangkan olahraga teratur dan diet seimbang.';
            } else {
                status = 'Obesitas';
                cls = 'bg-red-100 text-red-700 border-red-200';
                emoji = '&#128162;';
                summary = 'Kamu mungkin berisiko untuk masalah kesehatan. Konsultasikan dengan profesional kesehatan.';
            }

            bmiValue.textContent = rounded;
            bmiStatus.textContent = status;
            bmiStatus.className = 'inline-block mt-2 px-3 py-1 rounded-full text-sm font-medium border ' + cls;
            bmiCard.className = 'rounded-2xl p-5 border ' + cls;
            bmiEmoji.innerHTML = emoji;
            bmiSummary.textContent = summary;

            bmiResult.classList.remove('hidden');
        }

        weightInput.addEventListener('input', calculateBMI);
        heightInput.addEventListener('input', calculateBMI);

        if (weightInput.value && heightInput.value) {
            calculateBMI();
        }
    </script>
    @endpush
</x-guest-layout>
