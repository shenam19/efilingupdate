@foreach($folders as $folder)
    <div class="file d-flex justify-content-between p-2 bg-default" >
        @if($folder->subfolders_count)
        <div class="dropdown-btn">
            <button class="btn p-0" data-toggle="collapse" href="#subfolder_{{$folder->id}}" role="button" aria-expanded="false" aria-controls="collapseExample">
                <i class="fas fa-caret-right"></i> 
            </button>
        </div>   
        @endif         
        <button class="btn p-0 file-info d-flex flex-grow-1" wire:click="$emit('setFile',{{$folder->id}})"
        data-toggle="tooltip" data-placement="bottom" title="{{$folder->name}}"
        >
            <div class="file_name">
                <i class="far fa-folder-open "></i> {{$folder->file_no}}. {{$folder->name}}
            </div>
        </button>
        <div class="file-menu mr-2">
            <a href="#" data-toggle="dropdown" class="file-options"><i class="fas fa-ellipsis-v"></i></a>
            <div class="dropdown-menu">
                <button class="dropdown-item btn btn-sm" data-toggle="modal" data-target="#folderCreate" onclick="setParentId('{{$folder->id}}')" >
                    <i class="fas fa-folder-plus mr-2"></i> ཡིག་ཁུག་གསར་བཟོ་བྱོས།
                </button>
                <div class="dropdown-divider"></div>
                <button type="button"  class="dropdown-item btn  btn-sm text-danger" wire:click="$set('delete_id',{{$folder->id}})" data-toggle="modal"
                data-target="#deleteFileModal">
                    <i class="fas fa-trash-alt mr-2"></i> སུབས།
                </button>
            </div>
        </div>
    </div>
    @if($folder->subfolders_count)
        <div class="collapse pl-3" id="subfolder_{{$folder->id}}">
            @include('folder.partials.file-list',['folders'=>$folder->subfolders()->withCount('subfolders')->get()])
        </div>
    @endif
@endforeach