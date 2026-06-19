@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-2 pe-4 py-2 text-start text-sm font-semibold text-forest-700 bg-forest-50 border-l-4 border-forest-600 focus:outline-none focus:text-forest-800 focus:bg-forest-50 focus:border-forest-700 transition duration-200'
            : 'block w-full ps-2 pe-4 py-2 text-start text-sm font-medium text-sage-600 hover:text-forest-700 hover:bg-sage-50 hover:border-l-4 hover:border-forest-300 focus:outline-none focus:text-forest-700 focus:bg-sage-50 focus:border-forest-300 transition duration-200';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
