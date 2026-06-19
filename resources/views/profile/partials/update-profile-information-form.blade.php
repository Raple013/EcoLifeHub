<section>
    <header>
        <h2 class="font-serif text-xl text-ink">{{ __('Profile Information') }}</h2>
        <p class="mt-1 text-sm text-muted">{{ __("Update your account's profile information and body metrics.") }}</p>
    </header>

    {{-- Photo --}}
    <div class="mt-6 flex items-center gap-6">
        <div class="shrink-0">
            @if ($user->hasPhoto())
                <img src="{{ $user->photoUrl() }}" alt="{{ $user->name }}"
                     class="w-20 h-20 rounded-full object-cover border-2 border-sage-200">
            @else
                <div class="w-20 h-20 rounded-full bg-forest-100 flex items-center justify-center text-2xl font-bold text-forest-700 border-2 border-sage-200">
                    {{ $user->initials() }}
                </div>
            @endif
        </div>
        <div class="space-y-2">
            <form action="{{ route('profile.photo.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <label class="btn-secondary text-xs cursor-pointer">
                    {{ __('Upload Photo') }}
                    <input type="file" name="photo" accept="image/jpeg,image/png,image/jpg,image/gif,image/webp" class="hidden" onchange="this.form.submit()">
                </label>
                <x-input-error class="mt-2" :messages="$errors->get('photo')" />
            </form>
            @if ($user->hasPhoto())
                <form action="{{ route('profile.photo.destroy') }}" method="POST">
                    @csrf @method('DELETE')
                    <button type="submit" class="text-xs text-red-500 hover:text-red-700 font-medium transition-colors"
                            onclick="return confirm('{{ __('Remove photo?') }}')">
                        {{ __('Remove Photo') }}
                    </button>
                </form>
            @endif
            @if (session('status') === 'photo-updated')
                <p class="text-xs text-forest-600 font-medium">Photo updated.</p>
            @elseif (session('status') === 'photo-removed')
                <p class="text-xs text-forest-600 font-medium">Photo removed.</p>
            @endif
        </div>
    </div>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-5">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        <div class="grid md:grid-cols-2 gap-5">
            <div>
                <x-input-label for="weight_kg" :value="__('Weight (kg)')" />
                <x-text-input id="weight_kg" name="weight_kg" type="number" step="0.1" min="20" max="300" class="mt-1 block w-full" :value="old('weight_kg', $user->weight_kg)" />
                <x-input-error class="mt-2" :messages="$errors->get('weight_kg')" />
            </div>
            <div>
                <x-input-label for="height_cm" :value="__('Height (cm)')" />
                <x-text-input id="height_cm" name="height_cm" type="number" min="80" max="250" class="mt-1 block w-full" :value="old('height_cm', $user->height_cm)" />
                <x-input-error class="mt-2" :messages="$errors->get('height_cm')" />
            </div>
        </div>

        <div>
            <x-input-label for="city" :value="__('City / Region')" />
            <x-text-input id="city" name="city" type="text" maxlength="100" class="mt-1 block w-full" :value="old('city', $user->city)" placeholder="e.g. Jakarta, Surabaya, Bandung" />
            <x-input-error class="mt-2" :messages="$errors->get('city')" />
            <p class="text-xs text-sage-400 mt-1">{{ __('Used for local weather and air quality on your dashboard.') }}</p>
        </div>

        @php $bmi = $user->bmi(); $bmiStatus = $user->bmiStatus(); @endphp
        @if ($bmi && $bmiStatus)
            <div class="rounded-2xl p-5 border {{ $user->bmiStatusClass() }}">
                <div class="flex items-center justify-between mb-2">
                    <span class="font-semibold text-forest-700">{{ __('Body Mass Index (BMI)') }}</span>
                    <span class="text-2xl">{!! $user->bmiEmoji() !!}</span>
                </div>
                <div class="flex items-baseline gap-2">
                    <span class="font-display text-3xl">{{ $bmi }}</span>
                    <span class="text-sage-500">{{ __('kg/m²') }}</span>
                    <span class="ml-2 px-3 py-0.5 rounded-full text-sm font-medium border {{ $user->bmiStatusClass() }}">{{ $bmiStatus }}</span>
                </div>
            </div>
        @else
            <div class="rounded-2xl p-5 border border-sage-200 bg-sage-50 text-sage-500 text-sm">
                &#128221; {{ __('Enter your weight and height to see your BMI and health status.') }}
            </div>
        @endif

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                   class="text-sm text-forest-600 bg-forest-50 px-3 py-1.5 rounded-lg font-medium">
                    Saved.
                </p>
            @endif
        </div>
    </form>
</section>
