<x-app-layout>
    <x-header>
        {{ __('ཟིན་བྲིས།') }}
    </x-header>

    <section class="content">
        <div class="row justify-content-center">
            @livewire('message-table',['type'=>'draft'])
    </section>
</x-app-layout>