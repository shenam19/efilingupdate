<div class="col-12">
    <div class="grid search">
        <div class="grid-body">
            <div class="row">
                <div class="col-8 d-flex">
                    <div class="form-search" style="width:300px"> 
                        <i class="fa fa-search"></i> 
                        <input type="text" name="table_search" class="form-control form-input mb-1" placeholder="འཚོལ།" wire:model="search"> 
                    </div>
                    @if($type != 'draft')
                    <div class="form-row ml-2">
                        <button type="button" class="btn btn-default btn-sm" data-target="#addToFolder" data-toggle="modal" @if(!count($selected)) disabled @endif>
                            <i class="fas fa-folder-plus"></i> ཡིག་ཁུག་ཏུ་བླུགས།
                        </button>
                        @livewire('add-to-folder')
                    </div>
                    @endif
                </div>
                <div class="col">
                    {{ $messages->links('vendor.pagination.custom') }}
                </div>
            </div>
            
            <div class="table-responsive">
                @include('mail.partials.table',compact('type','orgs'))
            </div>
        </div>
    </div>
</div> 


