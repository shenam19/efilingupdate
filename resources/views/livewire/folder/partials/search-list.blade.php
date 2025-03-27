<small class="text-muted">Search results..</small>
@foreach ($folders as $folder)
    <div class="file d-flex justify-content-between p-2 bg-default">
        <button class="btn p-0 file-info d-flex flex-grow-1" wire:click="$dispatch('setFile',{{ $folder->id }})">
            <div class="file_name">
                <i class="far fa-folder-open "></i> {{ $folder->file_no }}. {{ $folder->name }}
            </div>
        </button>
        {{-- <button class="btn p-0 file-info d-flex flex-grow-1" wire:click="$emit('setFile',{{$folder->id}})">
            <div class="file_name">
                <i class="far fa-folder-open "></i> {{$folder->file_no}}. {{$folder->name}}
            </div>
        </button> --}}
        <div class="file-menu mr-2">
            <a href="#" data-toggle="dropdown" class="file-options"><i class="fas fa-ellipsis-v"></i></a>
            <div class="dropdown-menu">
                <button class="dropdown-item btn btn-sm" data-toggle="modal" data-target="#folderCreate"
                    onclick="setParentId('{{ $folder->id }}')">
                    <i class="fas fa-folder-plus mr-2"></i> ཡིག་ཁུག་གསར་བཟོ་བྱོས།
                </button>
                <div class="dropdown-divider"></div>
                <button type="button" class="dropdown-item btn  btn-sm text-danger"
                    wire:click="$set('delete_id',{{ $folder->id }})" data-toggle="modal"
                    data-target="#deleteFileModal">
                    <i class="fas fa-trash-alt mr-2"></i> Delete
                </button>
            </div>
        </div>
    </div>
@endforeach
