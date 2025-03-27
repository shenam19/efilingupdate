<x-jet-form-section submit="updatePassword">
    <x-slot name="title">
        <div data-toggle="tooltip" data-placement="top" title="update password"> {{ __('གསང་ཚིག་གསར་བཟོ།') }} </div>
    </x-slot>

    <x-slot name="description">
        {{ __('བདེ་འཇགས་ཆེད་ཁྱེད་ཀྱི་གསང་ཚིག་གསར་པ་རིང་པོ་དང་བཙན་པོ་བྱུང་ན་ལེགས།') }}
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="current_password" value="{{ __('ད་ལྟའི་གསང་ཚིག') }}" />
            <x-jet-input id="current_password" type="password" class="mt-1 block w-full"
                wire:model="state.current_password" autocomplete="current-password" />
            {{-- <x-jet-input id="current_password" type="password" class="mt-1 block w-full" wire:model.defer="state.current_password" autocomplete="current-password" /> --}}
            <x-jet-input-error for="current_password" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="password" value="{{ __('གསང་ཚིག་གསར་པ།') }}" />
            <x-jet-input id="password" type="password" class="mt-1 block w-full" wire:model="state.password"
                autocomplete="new-password" />
            {{-- <x-jet-input id="password" type="password" class="mt-1 block w-full" wire:model.defer="state.password"
                autocomplete="new-password" /> --}}
            <x-jet-input-error for="password" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="password_confirmation" value="{{ __('གསང་ཚིག་གསར་པ་ངེས་བརྟན་བཟོ་རོགས།') }}" />
            <x-jet-input id="password_confirmation" type="password" class="mt-1 block w-full"
                wire:model="state.password_confirmation" autocomplete="new-password" />
            {{-- <x-jet-input id="password_confirmation" type="password" class="mt-1 block w-full"
                wire:model.defer="state.password_confirmation" autocomplete="new-password" /> --}}
            <x-jet-input-error for="password_confirmation" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('གསོག་འཇོག་ཟིན་པ།') }}
        </x-jet-action-message>

        <x-jet-button class="btn-light btn-sm">
            {{ __('གསོག་འཇོག') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>
