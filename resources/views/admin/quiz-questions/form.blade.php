@extends('admin.layouts.app')

@section('title', $question ? __('Edit Question') : __('New Question'))
@section('breadcrumb', $question ? __('Edit Question') : __('New Question'))

@section('content')
    <div class="max-w-3xl mx-auto">
        <a href="{{ route('admin.quiz-questions.index') }}"
           class="inline-flex items-center gap-1.5 text-muted hover:text-forest-600 text-sm font-medium transition-colors mb-6">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            {{ __('Back to Questions') }}
        </a>

        <form action="{{ $question ? route('admin.quiz-questions.update', $question) : route('admin.quiz-questions.store') }}"
              method="POST" class="space-y-6">
            @csrf
            @if ($question) @method('PUT') @endif

            <div class="card p-4 md:p-6 space-y-5">
                <div>
                    <label for="question" class="input-label">{{ __('Question') }}</label>
                    <textarea name="question" id="question" rows="3" class="input-field" required
                              maxlength="500">{{ old('question', $question?->question) }}</textarea>
                    <x-input-error :messages="$errors->get('question')" />
                </div>

                <div>
                    <label class="input-label">{{ __('Answer Options') }}</label>
                    <p class="text-xs text-muted/60 mb-3">{{ __('Enter 2 to 6 options. Select the correct one below.') }}</p>
                    <div id="optionsContainer" class="space-y-2">
                        @php
                            $options = old('options', $question?->options ?? ['', '']);
                        @endphp
                        @foreach ($options as $i => $opt)
                            <div class="flex items-center gap-2 option-row">
                                <input type="text" name="options[]" value="{{ $opt }}"
                                       class="input-field flex-1" placeholder="{{ __('Option') }} {{ $i + 1 }}" required maxlength="255">
                                @if ($loop->index >= 2)
                                    <button type="button" class="remove-option p-2 rounded-lg text-muted hover:text-red-600 hover:bg-red-50 transition-all duration-200"
                                            onclick="this.closest('.option-row').remove()">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                    </button>
                                @endif
                            </div>
                        @endforeach
                    </div>
                    <button type="button" id="addOptionBtn" class="mt-2 inline-flex items-center gap-1 text-sm text-forest-600 hover:text-forest-700 font-medium transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        {{ __('Add Option') }}
                    </button>
                    <x-input-error :messages="$errors->get('options')" />
                    <x-input-error :messages="$errors->get('options.*')" />
                </div>

                <div>
                    <label for="explanation" class="input-label">{{ __('Explanation') }}</label>
                    <textarea name="explanation" id="explanation" rows="2" class="input-field"
                              maxlength="1000">{{ old('explanation', $question?->explanation) }}</textarea>
                    <p class="text-xs text-muted/60 mt-1">{{ __('Optional explanation shown after answering.') }}</p>
                    <x-input-error :messages="$errors->get('explanation')" />
                </div>

                <div>
                    <label for="answer" class="input-label">{{ __('Correct Answer') }}</label>
                    <select name="answer" id="answer" class="input-field" required>
                        <option value="">{{ __('Select correct answer') }}</option>
                        @foreach ($options as $i => $opt)
                            <option value="{{ $opt }}"
                                {{ old('answer', $question?->answer) === $opt ? 'selected' : '' }}>
                                {{ $opt ?: __('Option') . ' ' . ($i + 1) }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('answer')" />
                </div>
            </div>

            <div class="flex items-center gap-3">
                <button type="submit" class="btn-primary px-4 md:px-8 py-3 w-full md:w-auto justify-center">
                    {{ $question ? __('Update Question') : __('Create Question') }}
                </button>
                <a href="{{ route('admin.quiz-questions.index') }}" class="px-4 md:px-6 py-3 text-muted hover:text-ink text-sm font-medium transition-colors">
                    {{ __('Cancel') }}
                </a>
            </div>
        </form>
    </div>

    @push('scripts')
    <script>
        document.getElementById('addOptionBtn').addEventListener('click', function() {
            const container = document.getElementById('optionsContainer');
            const rows = container.querySelectorAll('.option-row');
            if (rows.length >= 6) return;
            const div = document.createElement('div');
            div.className = 'flex items-center gap-2 option-row';
            div.innerHTML = `
                <input type="text" name="options[]" value=""
                       class="input-field flex-1" placeholder="{{ __('Option') }} ${rows.length + 1}" required maxlength="255">
                <button type="button" class="remove-option p-2 rounded-lg text-muted hover:text-red-600 hover:bg-red-50 transition-all duration-200"
                        onclick="this.closest('.option-row').remove()">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            `;
            container.appendChild(div);
            syncAnswerOptions();
        });

        function syncAnswerOptions() {
            const select = document.getElementById('answer');
            const currentVal = select.value;
            const inputs = document.querySelectorAll('input[name="options[]"]');
            select.innerHTML = '<option value="">' + '{{ __('Select correct answer') }}' + '</option>';
            inputs.forEach((inp, i) => {
                const opt = document.createElement('option');
                opt.value = inp.value;
                opt.textContent = inp.value || '{{ __('Option') }} ' + (i + 1);
                if (inp.value === currentVal) opt.selected = true;
                select.appendChild(opt);
            });
        }

        document.getElementById('optionsContainer').addEventListener('input', function(e) {
            if (e.target.matches('input[name="options[]"]')) {
                syncAnswerOptions();
            }
        });
    </script>
    @endpush
@endsection
