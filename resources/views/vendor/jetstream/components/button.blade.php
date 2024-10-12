<button {{ $attributes->merge(['type' => 'submit', 'class' => 'px-4 py-2 border border-transparent rounded font-semibold tracking-widest btn']) }}>
    {{ $slot }}
</button>
