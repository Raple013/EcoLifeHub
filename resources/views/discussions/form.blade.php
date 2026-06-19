<x-app-layout>
    <div class="max-w-3xl mx-auto py-10 px-4">

        <a href="{{ route('discussions.index') }}"
           class="inline-flex items-center gap-1 text-sage-500 hover:text-forest-600 text-sm mb-6 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            {{ __('Back to Discussions') }}
        </a>

        <div class="card p-6 md:p-8">
            <h1 class="font-display text-2xl text-forest-800 mb-6">&#128221; {{ __('New Discussion Thread') }}</h1>

            <form action="{{ route('discussions.store') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label for="title" class="input-label">{{ __('Title') }}</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}"
                           class="input-field" required maxlength="255" placeholder="{{ __('What do you want to discuss?') }}">
                    <x-input-error :messages="$errors->get('title')" />
                </div>

                <div>
                    <label for="category" class="input-label">{{ __('Category') }}</label>
                    <select name="category" id="category" class="input-field" required>
                        <option value="general" {{ old('category') === 'general' ? 'selected' : '' }}>{{ __('General') }}</option>
                        <option value="nutrition" {{ old('category') === 'nutrition' ? 'selected' : '' }}>{{ __('Nutrition') }}</option>
                        <option value="sdg" {{ old('category') === 'sdg' ? 'selected' : '' }}>SDG</option>
                        <option value="health" {{ old('category') === 'health' ? 'selected' : '' }}>{{ __('Health') }}</option>
                        <option value="tips" {{ old('category') === 'tips' ? 'selected' : '' }}>{{ __('Tips & Tricks') }}</option>
                        <option value="lainnya" {{ old('category') === 'lainnya' ? 'selected' : '' }}>{{ __('Other') }}</option>
                    </select>
                    <x-input-error :messages="$errors->get('category')" />
                </div>

                <div>
                    <label for="body" class="input-label">{{ __('Content') }}</label>
                    <textarea name="body" id="body" rows="8" class="input-field" required
                              maxlength="10000" placeholder="{{ __('Write your thoughts...') }}">{{ old('body') }}</textarea>
                    <x-input-error :messages="$errors->get('body')" />
                </div>

                <div class="flex items-center gap-3">
                    <button type="submit" class="btn-primary px-8 py-3">
                        &#128172; {{ __('Create Thread') }}
                    </button>
                    <a href="{{ route('discussions.index') }}" class="px-6 py-3 text-sage-500 hover:text-sage-700 text-sm font-medium transition-colors">
                        {{ __('Cancel') }}
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
