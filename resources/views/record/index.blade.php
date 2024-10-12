<x-app-layout>
    <x-header>
        {{$type=== 'outgoing' ? 'ཕྱིར་བཏང་' : 'ནང་འབྱོར་' }}{{ __('ཟིན་ཐོ།')}}
        @if($type === 'outgoing')
            <i class="fas fa-arrow-up text-success align-middle"></i>
        @else
            <i class="fas fa-arrow-down text-primary align-middle"></i>
        @endif
        <x-slot name="button">
            <a href="{{ route('record.create',$type)}}" class="btn btn-block btn-primary">
                <i class="fas fa-plus align-middle"></i>
                སྣོན།
            </a>
        </x-slot>
    </x-header>

    <div class="container-fluid">
        <div class="row">
            <!-- BEGIN SEARCH RESULT -->
            <div class="col-md-12">
                <div class="grid search">
                    <div class="grid-body" style="height:90vh;overflow-y: scroll;">
                        @livewire('record-table',compact('type'))
                    </div>
                </div>
            </div>
            <!-- END SEARCH RESULT -->
        </div>
    </div>
</x-app-layout>

