<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-5 py-2.5 bg-clay-600 border border-transparent rounded-xl font-semibold text-xs text-white uppercase tracking-widest hover:bg-clay-500 active:bg-clay-700 focus:outline-none focus:ring-2 focus:ring-clay-500 focus:ring-offset-2 transition-all duration-200']) }}>
    {{ $slot }}
</button>
