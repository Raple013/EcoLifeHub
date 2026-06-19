<x-app-layout>
    <div class="max-w-5xl mx-auto py-10 px-4">
        <div class="text-center mb-10">
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gold-100 text-gold-700 mb-4">
                &#128221; {{ __('Test Your Knowledge') }}
            </span>
            <h1 class="font-display text-4xl md:text-5xl text-forest-800">{{ __('Quiz') }}</h1>
            <p class="text-sage-500 mt-2">{{ __('Answer') }} {{ $count }} {{ __('questions from various topics') }}</p>
        </div>

        {{-- Topic selector --}}
        @php
            $topics = [
                'all' => __('All Topics'),
                'sdg' => 'SDG',
                'nutrition' => __('Nutrition'),
                'health' => __('Health'),
                'environment' => __('Environment'),
                'general' => __('General'),
            ];
        @endphp
        <div class="flex flex-wrap justify-center gap-2 mb-6">
            @foreach ($topics as $key => $label)
                <a href="{{ route('quiz', ['topic' => $key, 'count' => $count]) }}"
                   class="px-4 py-2 rounded-xl text-sm font-semibold transition-colors
                   {{ ($topic === $key) || (!$topic && $key === 'all') ? 'bg-forest-600 text-white shadow-lg shadow-forest-600/25' : 'bg-sage-100 text-sage-700 hover:bg-sage-200' }}">
                    {{ $label }}
                </a>
            @endforeach
        </div>

        {{-- Question count selector --}}
        <div class="flex justify-center gap-3 mb-10">
            @foreach ([3, 5, 10] as $n)
                <a href="{{ route('quiz', ['topic' => $topic, 'count' => $n]) }}"
                   class="px-5 py-2.5 rounded-xl text-sm font-semibold transition-colors
                   {{ $count === $n ? 'bg-forest-600 text-white shadow-lg shadow-forest-600/25' : 'bg-sage-100 text-sage-700 hover:bg-sage-200' }}">
                    {{ $n }} {{ __('soal') }}
                </a>
            @endforeach
        </div>

        <form action="{{ route('quiz.result') }}" method="POST" id="quizForm">
            @csrf
            <input type="hidden" name="count" value="{{ $count }}">

            <div class="space-y-6">
                @forelse($questions as $index => $question)
                    <div class="card p-6 md:p-8" data-question="{{ $index }}">
                        <div class="flex items-center gap-3 mb-5">
                            <span class="flex-shrink-0 w-8 h-8 rounded-full bg-forest-600 text-white flex items-center justify-center text-sm font-bold">
                                {{ $index + 1 }}
                            </span>
                            <h3 class="font-bold text-lg text-forest-800">{{ $question['question'] }}</h3>
                        </div>

                        <div class="space-y-2">
                            @foreach($question['options'] as $oIndex => $option)
                                <label class="flex items-center gap-3 p-4 rounded-2xl border-2 border-sage-100 hover:border-forest-300 hover:bg-forest-50 cursor-pointer transition-all duration-200 group quiz-option"
                                       data-question="{{ $index }}" data-value="{{ $option }}">
                                    <input type="radio" name="answers[{{ $index }}]" value="{{ $option }}"
                                           class="w-4 h-4 text-forest-600 focus:ring-forest-500 border-sage-300 quiz-radio">
                                    <span class="text-sage-700 group-hover:text-forest-700 font-medium">{{ $option }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                @empty
                    <div class="card p-12 text-center">
                        <p class="text-5xl mb-4">&#128221;</p>
                        <h3 class="font-display text-2xl text-forest-800 mb-2">{{ __('No questions available') }}</h3>
                        <p class="text-sage-500">{{ __('Try a different topic or question count.') }}</p>
                    </div>
                @endforelse
            </div>

            @if ($questions->count() > 0)
                <div class="mt-8 bg-white rounded-2xl border border-sage-200 p-6">
                    <div class="flex justify-between text-sm text-sage-600 mb-2">
                        <span>{{ __('Progress') }}</span>
                        <span id="progressText" class="font-semibold text-forest-700">0 / {{ $count }}</span>
                    </div>
                    <div class="progress-bar h-3">
                        <div id="progressFill" class="progress-fill bg-forest-500" style="width: 0%"></div>
                    </div>
                </div>

                <div class="mt-6 text-center">
                    <button type="submit" id="submitBtn" class="btn-primary text-base py-4 px-10">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        {{ __('Submit Quiz') }}
                    </button>
                </div>
            @endif
        </form>
    </div>

    @push('scripts')
    <script>
        document.querySelectorAll('.quiz-radio').forEach(radio => {
            radio.addEventListener('change', function() {
                const questionCards = document.querySelectorAll('[data-question]');
                let answered = 0;
                questionCards.forEach(card => {
                    const radios = card.querySelectorAll('.quiz-radio');
                    radios.forEach(r => { if (r.checked) answered++; });
                });
                const total = {{ $count }};
                document.getElementById('progressText').textContent = answered + ' / ' + total;
                document.getElementById('progressFill').style.width = (answered / total * 100) + '%';
            });
        });

        document.getElementById('quizForm').addEventListener('submit', function(e) {
            const answered = document.querySelectorAll('.quiz-radio:checked').length;
            if (answered < {{ $count }}) {
                e.preventDefault();
                if (!confirm('{{ __('You have only answered') }} ' + answered + ' / {{ $count }} {{ __("questions. Submit anyway?") }}')) return;
                this.submit();
            }
        });
    </script>
    @endpush
</x-app-layout>
