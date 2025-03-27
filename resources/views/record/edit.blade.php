<x-app-layout>

    <div class="container-fluid">
        <div class="row">
            <div class="container">
                <x-header>
                    {{ $type === 'outgoing' ? __('ཕྱིར་བཏང་།') : __('ནང་འབྱོར།') }}
                </x-header>
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">
                            {{ $type === 'outgoing' ? 'ཕྱིར་བཏང་ཟིན་ཐོ་བྲིས།' : 'ནང་འབྱོར་ཟིན་ཐོ་བྲིས།' }}</h3>
                    </div>


                    @includeWhen($type === 'incoming', 'record.partials.edit-incoming-form')
                    @includeWhen($type === 'outgoing', 'record.partials.edit-outgoing-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
