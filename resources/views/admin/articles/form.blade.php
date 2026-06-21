@extends('admin.layouts.app')

@section('title', $article ? __('Edit Article') : __('New Article'))
@section('breadcrumb', $article ? __('Edit Article') : __('New Article'))

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet">
<style>
    .ql-editor { min-height: 400px; font-size: 16px; line-height: 1.7; font-family: 'DM Sans', sans-serif; }
    .ql-toolbar { border-radius: 12px 12px 0 0; border-color: #bfcfba !important; }
    .ql-container { border-radius: 0 0 12px 12px; border-color: #bfcfba !important; }
    .ql-editor.ql-blank::before { color: #7a8a7a; font-style: normal; }
    .ql-toolbar .ql-stroke { stroke: #1a3c2a; }
    .ql-toolbar .ql-fill { fill: #1a3c2a; }
    .ql-toolbar .ql-picker-label { color: #1a3c2a; }
    .ql-toolbar button:hover .ql-stroke { stroke: #3d6b42; }
    .ql-toolbar button:hover .ql-fill { fill: #3d6b42; }
    .ql-toolbar .ql-active .ql-stroke { stroke: #1a3c2a; }
    .ql-toolbar .ql-active .ql-fill { fill: #1a3c2a; }
</style>
@endpush

@section('content')
    <div class="max-w-3xl mx-auto">
        <a href="{{ route('admin.articles.index') }}"
           class="inline-flex items-center gap-1.5 text-muted hover:text-forest-600 text-sm font-medium transition-colors mb-6">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            {{ __('Back to Articles') }}
        </a>

        <form action="{{ $article ? route('admin.articles.update', $article) : route('admin.articles.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @if ($article) @method('PUT') @endif

            <div class="card p-4 md:p-6 space-y-5">
                <div class="grid md:grid-cols-2 gap-5">
                    <div class="md:col-span-2">
                        <label for="title" class="input-label">{{ __('Title') }}</label>
                        <input type="text" name="title" id="title" value="{{ old('title', $article?->title) }}" class="input-field" required>
                        <x-input-error :messages="$errors->get('title')" />
                    </div>

                    <div>
                        <label for="slug" class="input-label">{{ __('Slug') }}</label>
                        <input type="text" name="slug" id="slug" value="{{ old('slug', $article?->slug) }}" class="input-field" placeholder="{{ __('Auto-generated if empty') }}">
                        <x-input-error :messages="$errors->get('slug')" />
                    </div>

                    <div>
                        <label for="category" class="input-label">{{ __('Category') }}</label>
                        <select name="category" id="category" class="input-field" required>
                            <option value="nutrition" {{ old('category', $article?->category) === 'nutrition' ? 'selected' : '' }}>Nutrition & Diet</option>
                            <option value="prevention" {{ old('category', $article?->category) === 'prevention' ? 'selected' : '' }}>Disease Prevention</option>
                            <option value="mental" {{ old('category', $article?->category) === 'mental' ? 'selected' : '' }}>Mental Health</option>
                            <option value="environment" {{ old('category', $article?->category) === 'environment' ? 'selected' : '' }}>Environmental Health</option>
                            <option value="fitness" {{ old('category', $article?->category) === 'fitness' ? 'selected' : '' }}>Fitness & Exercise</option>
                        </select>
                        <x-input-error :messages="$errors->get('category')" />
                    </div>

                    <div>
                        <label for="language" class="input-label">{{ __('Language') }}</label>
                        <select name="language" id="language" class="input-field" required>
                            <option value="en" {{ old('language', $article?->language) === 'en' ? 'selected' : '' }}>English</option>
                            <option value="id" {{ old('language', $article?->language) === 'id' ? 'selected' : '' }}>Bahasa Indonesia</option>
                        </select>
                        <x-input-error :messages="$errors->get('language')" />
                    </div>
                </div>

                <div>
                    <label for="excerpt" class="input-label">{{ __('Excerpt') }}</label>
                    <textarea name="excerpt" id="excerpt" rows="3" class="input-field" maxlength="500">{{ old('excerpt', $article?->excerpt) }}</textarea>
                    <p class="text-xs text-muted/60 mt-1.5">{{ __('Short summary shown on cards (max 500 chars)') }}</p>
                    <x-input-error :messages="$errors->get('excerpt')" />
                </div>

                <div>
                    <label for="image" class="input-label">{{ __('Cover Image') }}</label>
                    <div class="flex items-start gap-4">
                        @if ($article && $article->image_url)
                            <img src="{{ Storage::url($article->image_url) }}" class="w-32 h-20 object-cover rounded-xl border border-sage-200">
                        @endif
                        <div class="flex-1">
                            <input type="file" name="image" id="image" accept="image/jpeg,image/png,image/webp" class="input-field text-sm py-2">
                            <p class="text-xs text-muted/60 mt-1.5">{{ __('Upload an image (JPEG, PNG, WebP, max 2MB)') }}</p>
                            <x-input-error :messages="$errors->get('image')" />
                        </div>
                    </div>
                </div>

                <div>
                    <label for="content" class="input-label">{{ __('Content') }}</label>
                    <div id="editor-container">{!! old('content', $article?->content) !!}</div>
                    <textarea name="content" id="content" class="hidden" required>{{ old('content', $article?->content) }}</textarea>
                    <x-input-error :messages="$errors->get('content')" />
                </div>

                <div class="grid md:grid-cols-2 gap-5">
                    <div>
                        <label for="source_url" class="input-label">{{ __('Source URL') }}</label>
                        <input type="url" name="source_url" id="source_url" value="{{ old('source_url', $article?->source_url) }}" class="input-field" placeholder="https://...">
                        <x-input-error :messages="$errors->get('source_url')" />
                    </div>

                    <div>
                        <label for="author" class="input-label">{{ __('Author') }}</label>
                        <input type="text" name="author" id="author" value="{{ old('author', $article?->author) }}" class="input-field">
                        <x-input-error :messages="$errors->get('author')" />
                    </div>
                </div>

                <label class="flex items-center gap-3 cursor-pointer group">
                    <input type="checkbox" name="is_published" value="1" {{ old('is_published', $article?->is_published ?? true) ? 'checked' : '' }}
                           class="w-5 h-5 rounded border-sage-300 text-forest-600 focus:ring-forest-500 group-hover:border-forest-400 transition-colors">
                    <span class="text-sm font-medium text-forest-700 group-hover:text-forest-600 transition-colors">{{ __('Published') }}</span>
                </label>
            </div>

            <div class="flex items-center gap-3">
                <button type="submit" class="btn-primary px-4 md:px-8 py-3 w-full md:w-auto justify-center">
                    {{ $article ? __('Update Article') : __('Create Article') }}
                </button>
                <a href="{{ route('admin.articles.index') }}" class="px-6 py-3 text-muted hover:text-ink text-sm font-medium transition-colors">
                    {{ __('Cancel') }}
                </a>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
<script>
    const quill = new Quill('#editor-container', {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ 'header': [1, 2, 3, false] }],
                ['bold', 'italic', 'underline'],
                [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                ['link', 'code-block'],
                ['clean']
            ]
        }
    });

    const form = document.querySelector('form');
    const textarea = document.getElementById('content');

    form.addEventListener('submit', function () {
        textarea.value = quill.root.innerHTML;
    });
</script>
@endpush
