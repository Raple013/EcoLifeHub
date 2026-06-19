<x-app-layout>
    <div class="max-w-3xl mx-auto py-10 px-4 space-y-8">
        {{-- Score card --}}
        <div class="card p-12 text-center">
            <div class="w-20 h-20 rounded-full bg-gold-100 flex items-center justify-center mx-auto mb-6">
                <span class="text-4xl">&#127942;</span>
            </div>

            <h1 class="font-display text-4xl text-forest-800 mb-2">{{ __('Quiz Complete!') }}</h1>
            <p class="text-sage-500 mb-8">{{ __('Your SDG Knowledge Score') }}</p>

            <div class="relative inline-flex items-center justify-center mb-6">
                <svg class="w-32 h-32 -rotate-90" viewBox="0 0 120 120">
                    <circle cx="60" cy="60" r="52" fill="none" stroke="#E3EBE3" stroke-width="8"/>
                    <circle cx="60" cy="60" r="52" fill="none" stroke="#1B4332" stroke-width="8"
                        stroke-dasharray="{{ 2 * pi() * 52 }}"
                        stroke-dashoffset="{{ 2 * pi() * 52 * (1 - $score / 100) }}"
                        stroke-linecap="round"
                        class="transition-all duration-1000"/>
                </svg>
                <span class="absolute font-display text-5xl text-forest-700">{{ $score }}</span>
            </div>

            @php
                $message = $score >= 80 ? __('Outstanding! You\'re an SDG Champion!') : ($score >= 60 ? __('Great job! Keep learning!') : __('Keep going! Try again to improve your score.'));
            @endphp
            <p class="text-sage-600 mb-4">{{ $message }}</p>
            <p class="text-sm text-sage-400 mb-8">{{ $count }} {{ __('questions') }} &bull; {{ collect($results)->where('is_correct', true)->count() }} {{ __('correct') }}</p>

            <a href="{{ route('quiz', ['count' => $count]) }}" class="btn-primary text-base py-4 px-10">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                {{ __('Try Again') }}
            </a>
        </div>

        {{-- Answer review --}}
        @if (count($results) > 0)
            <div>
                <h2 class="font-display text-2xl text-forest-800 mb-6">&#128270; {{ __('Answer Review') }}</h2>
                <div class="space-y-4">
                    @foreach ($results as $index => $r)
                        <div class="card p-6 border-l-4 {{ $r['is_correct'] ? 'border-l-green-500' : 'border-l-red-500' }}">
                            <div class="flex items-start gap-3 mb-4">
                                <span class="flex-shrink-0 w-8 h-8 rounded-full {{ $r['is_correct'] ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }} flex items-center justify-center text-sm font-bold">
                                    {{ $index + 1 }}
                                </span>
                                <div class="flex-1">
                                    <h3 class="font-bold text-forest-800">{{ $r['question'] }}</h3>
                                    <span class="inline-flex items-center gap-1 mt-1 text-xs font-medium {{ $r['is_correct'] ? 'text-green-600' : 'text-red-600' }}">
                                        @if ($r['is_correct'])
                                            &#10003; {{ __('Correct') }}
                                        @else
                                            &#10007; {{ __('Incorrect') }}
                                        @endif
                                    </span>
                                </div>
                            </div>

                            <div class="space-y-2 ml-11">
                                @foreach ($r['options'] as $option)
                                    @php
                                        $isUserAnswer = $option === $r['user_answer'];
                                        $isCorrectAnswer = $option === $r['correct_answer'];
                                    @endphp
                                    <div class="flex items-center gap-3 p-3 rounded-xl text-sm font-medium
                                        {{ $isCorrectAnswer ? 'bg-green-50 text-green-700 border border-green-200' : ($isUserAnswer && !$isCorrectAnswer ? 'bg-red-50 text-red-700 border border-red-200' : 'bg-sage-50 text-sage-600 border border-sage-100') }}">
                                        <span class="flex-shrink-0 w-5 h-5 rounded-full flex items-center justify-center text-xs
                                            {{ $isCorrectAnswer ? 'bg-green-500 text-white' : ($isUserAnswer ? 'bg-red-500 text-white' : 'bg-sage-300 text-white') }}">
                                            {{ $isCorrectAnswer ? '✓' : ($isUserAnswer ? '✗' : '') }}
                                        </span>
                                        {{ $option }}
                                        @if ($isCorrectAnswer)
                                            <span class="ml-auto text-xs font-semibold text-green-600">{{ __('Correct Answer') }}</span>
                                        @elseif ($isUserAnswer)
                                            <span class="ml-auto text-xs font-semibold text-red-600">{{ __('Your Answer') }}</span>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
