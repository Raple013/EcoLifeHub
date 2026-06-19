<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-5 py-2.5 bg-white border-2 border-sage-200 rounded-xl font-semibold text-xs text-sage-700 uppercase tracking-widest shadow-sm hover:bg-sage-50 hover:border-sage-300 focus:outline-none focus:ring-2 focus:ring-forest-500 focus:ring-offset-2 disabled:opacity-25 transition-all duration-200']) }}>
    {{ $slot }}
</button>
