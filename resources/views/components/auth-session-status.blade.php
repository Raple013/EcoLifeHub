@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-medium text-sm text-forest-600 bg-forest-50 px-4 py-3 rounded-xl']) }}>
        {{ $status }}
    </div>
@endif
