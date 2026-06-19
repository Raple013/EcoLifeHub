<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>EcoLife Hub</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=playfair-display:400,500,600,700|dm-sans:400,400i,500,600,700&display=swap" rel="stylesheet" />
        <link rel="icon" type="image/svg+xml" href="/favicon.svg">
        <link rel="alternate icon" href="/favicon.ico">

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
                * { margin: 0; padding: 0; box-sizing: border-box; }
                body { font-family: 'DM Sans', sans-serif; -webkit-font-smoothing: antialiased; color: #1c1c1c; background: #f5f2ec; }
                h1, h2, h3, h4 { font-family: 'Playfair Display', Georgia, serif; letter-spacing: -0.01em; }

                .animate-on-load { opacity: 0; animation: fadeUp 0.6s ease-out forwards; }
                .stagger-1 { animation-delay: 0.1s; }
                .stagger-2 { animation-delay: 0.2s; }
                .stagger-3 { animation-delay: 0.3s; }
                .stagger-4 { animation-delay: 0.4s; }

                .grain-overlay {
                    position: fixed; inset: 0; z-index: 9999; pointer-events: none; opacity: 0.025;
                    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)'/%3E%3C/svg%3E");
                    background-repeat: repeat; background-size: 256px 256px;
                }

                @keyframes fadeUp {
                    0% { opacity: 0; transform: translateY(20px); }
                    100% { opacity: 1; transform: translateY(0); }
                }
            </style>
        @endif
    </head>
    <body>
        <div class="grain-overlay"></div>

        {{-- Header --}}
        <header class="fixed top-0 left-0 right-0 z-50 bg-white/90 border-b border-sage-100" style="backdrop-filter: blur(8px);">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <a href="/" class="font-serif text-xl text-forest-600 tracking-tight">
                        EcoLife Hub
                    </a>

                    <nav class="flex items-center gap-4">
                        <form action="{{ route('language.switch', app()->getLocale() === 'id' ? 'en' : 'id') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="px-3 py-1.5 border border-sage-200 text-xs font-medium text-muted hover:text-ink hover:border-forest-400 transition-colors rounded-lg">
                                {{ app()->getLocale() === 'id' ? 'EN' : 'ID' }}
                            </button>
                        </form>

                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="px-6 py-2.5 bg-forest-600 text-cream font-medium text-sm tracking-wide hover:bg-forest-700 transition-colors rounded-xl">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="text-sm text-muted hover:text-ink transition-colors tracking-wide">Log in</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="px-6 py-2.5 bg-forest-600 text-cream font-medium text-sm tracking-wide hover:bg-forest-700 transition-colors rounded-xl">Get Started</a>
                                @endif
                            @endauth
                        @endif
                    </nav>
                </div>
            </div>
        </header>

        <main>
            {{-- Hero --}}
            <section class="relative min-h-screen flex items-center overflow-hidden bg-gradient-to-br from-forest-600 via-forest-700 to-ink pt-16">
                <div class="absolute inset-0 opacity-[0.04]"
                     style="background-image: radial-gradient(circle at 25% 50%, #fff 1px, transparent 1px); background-size: 40px 40px;">
                </div>
                <div class="max-w-7xl mx-auto px-6 lg:px-8 py-24 lg:py-32 w-full relative z-10">
                    <div class="max-w-3xl">
                        <p class="text-forest-300 text-xs font-medium uppercase tracking-[0.2em] mb-6 animate-on-load">
                            United Nations Sustainable Development Goals
                        </p>

                        <h1 class="font-serif text-5xl md:text-7xl lg:text-8xl text-cream leading-[1.08] mb-6 animate-on-load stagger-1">
                            Small Actions,
                            <br>
                            <span class="text-gold-400 italic">Sustainable Future</span>
                        </h1>

                        <p class="text-lg md:text-xl text-forest-200 max-w-xl mb-10 animate-on-load stagger-2 leading-relaxed">
                            Track your nutrition, log your activities, and contribute to a healthier planet &mdash; one small step at a time.
                        </p>

                        <div class="flex flex-wrap gap-4 animate-on-load stagger-3">
                            @guest
                                <a href="{{ route('register') }}" class="inline-flex items-center px-8 py-3.5 bg-gold-400 hover:bg-gold-500 text-forest-900 font-medium text-sm tracking-wide transition-all rounded-xl">
                                    Start Your Journey
                                    <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                                </a>
                                <a href="{{ route('login') }}" class="inline-flex items-center px-8 py-3.5 border-2 border-cream/20 text-cream font-medium text-sm tracking-wide hover:bg-cream/5 transition-all rounded-xl">
                                    Sign In
                                </a>
                            @endguest
                        </div>
                    </div>
                </div>
            </section>

            {{-- Features --}}
            <section class="py-24 lg:py-32 bg-cream">
                <div class="max-w-7xl mx-auto px-6 lg:px-8">
                    <div class="text-center mb-16">
                        <p class="text-xs text-muted font-medium uppercase tracking-[0.2em] mb-4">How It Works</p>
                        <h2 class="font-serif text-4xl md:text-5xl text-ink mb-4">Your Journey to Sustainability</h2>
                        <p class="text-muted max-w-xl mx-auto">Three simple pillars to help you build a sustainable lifestyle</p>
                    </div>

                    <div class="grid md:grid-cols-3 gap-8">
                        <div class="bg-white border border-sage-100 rounded-2xl p-8 md:p-10 text-center stagger-1 animate-on-load shadow-card hover:shadow-card-hover transition-shadow">
                            <h3 class="font-serif text-2xl text-ink mb-4">Track</h3>
                            <p class="text-muted leading-relaxed text-sm">
                                Log your daily meals and activities, learn about SDGs through interactive quizzes, and earn achievement badges.
                            </p>
                        </div>

                        <div class="bg-white border border-sage-100 rounded-2xl p-8 md:p-10 text-center stagger-2 animate-on-load shadow-card hover:shadow-card-hover transition-shadow">
                            <h3 class="font-serif text-2xl text-ink mb-4">Learn</h3>
                            <p class="text-muted leading-relaxed text-sm">
                                Explore all 17 UN Sustainable Development Goals through interactive content and quizzes.
                            </p>
                        </div>

                        <div class="bg-white border border-sage-100 rounded-2xl p-8 md:p-10 text-center stagger-3 animate-on-load shadow-card hover:shadow-card-hover transition-shadow">
                            <h3 class="font-serif text-2xl text-ink mb-4">Earn</h3>
                            <p class="text-muted leading-relaxed text-sm">
                                Unlock achievement badges as you progress and build a consistent sustainable routine.
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            {{-- SDG Strip --}}
            <section class="py-16 bg-ink">
                <div class="max-w-7xl mx-auto px-6 lg:px-8 text-center">
                    <h2 class="font-serif text-3xl md:text-4xl text-cream mb-3">Supporting All 17 SDGs</h2>
                    <p class="text-muted mb-10">Aligned with the United Nations Sustainable Development Goals</p>
                    <div class="flex flex-wrap gap-3 justify-center">
                        @foreach(['No Poverty','Zero Hunger','Good Health','Quality Education','Gender Equality','Clean Water','Clean Energy','Decent Work','Industry & Innovation','Reduced Inequalities','Sustainable Cities','Responsible Consumption','Climate Action','Life Below Water','Life On Land','Peace & Justice','Partnerships'] as $i => $sdg)
                            <span class="inline-flex items-center gap-2 px-4 py-2 border border-cream/10 text-sage-200 text-sm hover:border-cream/30 transition-colors rounded-lg">
                                <span class="font-medium text-gold-400">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                {{ $sdg }}
                            </span>
                        @endforeach
                    </div>
                </div>
            </section>

            {{-- CTA --}}
            <section class="py-24 lg:py-32 bg-cream">
                <div class="max-w-2xl mx-auto text-center px-6">
                    <h2 class="font-serif text-4xl md:text-5xl text-ink mb-6">Ready to Make a Difference?</h2>
                    <p class="text-muted text-lg mb-10">Join a community of changemakers tracking their impact on the planet.</p>
                    @guest
                        <a href="{{ route('register') }}" class="inline-flex items-center px-10 py-3.5 bg-forest-600 hover:bg-forest-700 text-cream font-medium text-sm tracking-wide transition-all rounded-xl">
                            Create Your Free Account
                            <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                        </a>
                    @endguest
                </div>
            </section>

            {{-- Footer --}}
            <footer class="bg-ink text-muted py-12 text-center text-sm border-t border-cream/10">
                <p class="font-serif text-lg text-sage-200 mb-3">EcoLife Hub</p>
                <p>&copy; {{ date('Y') }} EcoLife Hub</p>
            </footer>
        </main>
    </body>
</html>
