@props(['user', 'class' => 'w-9 h-9 text-sm'])
@if ($user->hasPhoto())
    <img src="{{ $user->photoUrl() }}" alt="{{ $user->name }}"
         class="{{ $class }} rounded-full object-cover border border-sage-200 shrink-0">
@else
    <div class="{{ $class }} rounded-full bg-forest-100 flex items-center justify-center font-bold text-forest-700 border border-sage-200 shrink-0">
        {{ $user->initials() }}
    </div>
@endif
