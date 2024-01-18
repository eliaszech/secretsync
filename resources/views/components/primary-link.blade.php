<a {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-primary rounded-md font-semibold text-xs text-accent-text uppercase tracking-widest']) }}>
    {{ $slot }}
</a>
