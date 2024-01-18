<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-theme-default rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-theme-default/80 transition ease-in-out duration-150']) }}>
    <i class="fal fa-sharp fa-exclamation-triangle mr-2"></i> {{ $slot }}
</button>
