<x-jet-form-section submit="updateProfileInformation">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <x-slot name="title">
                    <div data-toggle="tooltip" data-placement="top" title="profile information">
                        {{ __('ངོ་སྤྲོད་གནས་ཚུལ།') }}
                    </div>
                </x-slot>

                <x-slot name="description">
                    {{ __('ཁྱེད་ཀྱི་ངོ་སྤྲོད་གནས་ཚུལ་དང་སྤྱོད་མིང་ངོ་རྟགས་འགེང་རོགས།') }}
                </x-slot>
            </div>

            <div class="col">
                <x-slot name="form">
                    <!-- Profile Photo -->
                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                        <div x-data="{ photoName: null, photoPreview: null }" class="col-md-6 sm:col-span-4 p-4">
                            <!-- Profile Photo File Input -->
                            <input type="file" wire:model.live="photo" x-ref="photo"
                                x-on:change="
                                                photoName = $refs.photo.files[0].name;
                                                const reader = new FileReader();
                                                reader.onload = (e) => {
                                                    photoPreview = e.target.result;
                                                };
                                                reader.readAsDataURL($refs.photo.files[0]);
                                        "
                                hidden />

                            <x-jet-label for="photo" value="{{ __('Photo') }}" />

                            <!-- Current Profile Photo -->
                            <div class="mt-2" x-show="! photoPreview">
                                <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}"
                                    class="rounded-circle w-25">
                            </div>

                            <!-- New Profile Photo Preview -->
                            @if ($photo)
                                <div class="mt-2" x-show="photoPreview">
                                    <img src="{{ $photo->temporaryUrl() }}" alt="{{ $this->user->name }}"
                                        class="rounded-circle h-25 w-25 object-cover">
                                </div>
                            @endif

                            <x-jet-secondary-button class="mt-2 mr-2" type="button"
                                x-on:click.prevent="$refs.photo.click()">
                                {{ __('Select A New Photo') }}
                            </x-jet-secondary-button>

                            @if ($this->user->profile_photo_path)
                                <x-jet-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                                    {{ __('Remove Photo') }}
                                </x-jet-secondary-button>
                            @endif

                            <x-jet-input-error for="photo" class="mt-2" />
                        </div>
                    @endif

                    <!-- Name -->
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="name" value="{{ __('མིང་།') }}" />
                        <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model="state.name"
                            autocomplete="name" />
                        {{-- <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="state.name"
                            autocomplete="name" /> --}}
                        <x-jet-input-error for="name" class="mt-2" />
                    </div>

                    <!-- Email -->
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="email" value="{{ __('སྤྱོད་མིང་ངོ་རྟགས།') }}" />
                        <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model="state.email" />
                        {{-- <x-jet-input id="email" type="email" class="mt-1 block w-full"
                            wire:model.defer="state.email" /> --}}
                        <x-jet-input-error for="email" class="mt-2" />
                    </div>

                    <!-- Official email -->
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="official_email" value="{{ __('Your tibet.net email') }}" />
                        <x-jet-input id="official_email" type="email" class="mt-1 block w-full"
                            wire:model="state.official_email" />
                        {{-- <x-jet-input id="official_email" type="email" class="mt-1 block w-full"
                            wire:model.defer="state.official_email" /> --}}
                        <x-jet-input-error for="official_email" class="mt-2" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="intercom" value="{{ __('ནང་འབྲེལ་ཁ་པར།') }}" />
                        <x-jet-input id="intercom" type="text" class="mt-1 block w-full"
                            wire:model="state.intercom" />
                        {{-- <x-jet-input id="intercom" type="text" class="mt-1 block w-full"
                            wire:model.defer="state.intercom" /> --}}
                        <x-jet-input-error for="intercom" class="mt-2" />
                    </div>
                </x-slot>

                <x-slot name="actions">
                    <x-jet-action-message class="mr-3" on="saved">
                        {{ __('གསོག་འཇོག་ཟིན་པ།') }}
                    </x-jet-action-message>

                    <x-jet-button wire:loading.attr="disabled" wire:target="photo" class="btn-light btn-sm">
                        {{ __('གསོག་འཇོག') }}
                    </x-jet-button>
                </x-slot>
            </div>
        </div>
    </div>


</x-jet-form-section>
