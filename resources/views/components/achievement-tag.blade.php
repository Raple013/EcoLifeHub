@php
    $ach = $user->relationLoaded('achievements') ? $user->achievements->sortByDesc('level')->first() : null;
@endphp
@if ($ach)
    <span class="inline-flex items-center px-2 py-0.5 text-[10px] font-semibold tracking-wide rounded-full border {{ $ach->color_class }} leading-none shrink-0">
        {{ $ach->name }}
    </span>
@endif
