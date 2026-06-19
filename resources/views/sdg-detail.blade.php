<x-app-layout>
    <div class="max-w-5xl mx-auto py-10 px-4">
        <a href="{{ route('learning') }}" class="inline-flex items-center gap-1 text-sage-500 hover:text-forest-600 text-sm mb-6 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            {{ __('Back to SDGs') }}
        </a>

        <div class="card overflow-hidden">
            <div class="hero-gradient relative p-8 md:p-12 text-white">
                <div class="organic-blob w-48 h-48 bg-gold-400/10 top-0 right-0"></div>
                <div class="organic-blob w-32 h-32 bg-clay-400/10 bottom-0 left-0"></div>

                <div class="relative z-10">
                    <span class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-semibold bg-white/10 text-gold-300 border border-gold-400/30 backdrop-blur-sm mb-4">
                        SDG {{ $sdg->id }}
                    </span>
                    <h1 class="font-display text-4xl md:text-5xl mt-3">{{ $sdg->title }}</h1>
                    <p class="text-sage-200 mt-3 text-lg max-w-2xl">{{ $sdg->description }}</p>
                </div>
            </div>

            <div class="p-8 md:p-12 space-y-10">
                <div>
                    <h2 class="font-display text-2xl text-forest-800 mb-4">{{ __('Why Is It Important?') }}</h2>
                    <p class="text-sage-600 leading-relaxed">{{ $sdg->importance }}</p>
                </div>

                <div>
                    <h2 class="font-display text-2xl text-forest-800 mb-4">{{ __('Key Targets') }}</h2>
                    <div class="space-y-3">
                        <div class="flex items-start gap-3 p-4 rounded-2xl bg-forest-50 border border-forest-100">
                            <span class="flex-shrink-0 w-6 h-6 rounded-full bg-forest-600 text-white flex items-center justify-center text-xs font-bold">1</span>
                            <p class="text-sage-700">{{ $sdg->target1 }}</p>
                        </div>
                        <div class="flex items-start gap-3 p-4 rounded-2xl bg-forest-50 border border-forest-100">
                            <span class="flex-shrink-0 w-6 h-6 rounded-full bg-forest-600 text-white flex items-center justify-center text-xs font-bold">2</span>
                            <p class="text-sage-700">{{ $sdg->target2 }}</p>
                        </div>
                        <div class="flex items-start gap-3 p-4 rounded-2xl bg-forest-50 border border-forest-100">
                            <span class="flex-shrink-0 w-6 h-6 rounded-full bg-forest-600 text-white flex items-center justify-center text-xs font-bold">3</span>
                            <p class="text-sage-700">{{ $sdg->target3 }}</p>
                        </div>
                    </div>
                </div>

                <div>
                    <h2 class="font-display text-2xl text-forest-800 mb-4">{{ __('How Can You Help?') }}</h2>
                    <div class="space-y-3">
                        <div class="flex items-start gap-3 p-4 rounded-2xl bg-gold-50 border border-gold-100">
                            <span class="text-xl flex-shrink-0">&#127793;</span>
                            <p class="text-sage-700">{{ $sdg->action1 }}</p>
                        </div>
                        <div class="flex items-start gap-3 p-4 rounded-2xl bg-gold-50 border border-gold-100">
                            <span class="text-xl flex-shrink-0">&#127795;</span>
                            <p class="text-sage-700">{{ $sdg->action2 }}</p>
                        </div>
                        <div class="flex items-start gap-3 p-4 rounded-2xl bg-gold-50 border border-gold-100">
                            <span class="text-xl flex-shrink-0">&#128161;</span>
                            <p class="text-sage-700">{{ $sdg->action3 }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
