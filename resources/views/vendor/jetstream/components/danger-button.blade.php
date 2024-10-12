<button {{ $attributes->merge(['type' => 'button', 'class' => 'px-4 py-2 border border-transparent rounded font-semibold  tracking-widest hover:bg-red-500 btn btn-danger']) }}>
    {{ $slot }}
</button>
