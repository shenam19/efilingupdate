@props(['submit'])

<div {{ $attributes->merge(['class' => 'row  d-flex']) }}>
    <div class="col-md-4">
        <x-jet-section-title>
            <x-slot name="title">{{ $title }}</x-slot>
            <x-slot name="description">{{ $description }}</x-slot>
        </x-jet-section-title>
    </div>

    <div class="col-md-7">
        <div class="md:mt-0 md:col-span-2">
            <form wire:submit.prevent="{{ $submit }}">
                <div class="px-4 py-5 bg-white sm:p-6 shadow {{ isset($actions) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">
                    <div class="grid grid-cols-6 gap-6 p-4">
                        {{ $form }}
                    </div>
                </div>

                @if (isset($actions))
                    <div class="d-flex items-center justify-content-end px-4 py-3 bg-secondary text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
                        {{ $actions }}
                    </div>
                @endif
            </form>
        </div>
    </div>
</div>
