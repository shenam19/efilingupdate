<button {{ $attributes->merge(['type' => 'button', 'class' => 'px-4 py-2 btn btn-secondary btn-sm']) }}>
    {{ $slot }}
</button>
