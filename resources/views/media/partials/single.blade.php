<div class="card">
    <a href="{{ route('media.show', $media->uuid) }}" target="_blank">
        <img class="card-img-top " height="140" src="{{ getThumb(getExtension($media->file_name), $media->uuid) }}"
            alt="Dist Photo 1">
    </a>
    @if (isset($action))
        <div class="card-img-overlay d-flex flex-column justify-content-start p-0" style="height:15%;">
            <div class="px-3 py-2" style="background:rgb(0,0,0,0.8)">
                @if ($action == 'attach')
                    <span class="">
                        {{-- <input type="checkbox" id="selectAll" wire:model.defer="selected_media" value ="{{$media->id}}" wire:click="$emit('setSelectedMedia','{{$media->id}}')"> --}}
                        <input type="checkbox" id="selectAll" wire:model="selected_media" value ="{{ $media->id }}"
                            wire:click="$dispatch('setSelectedMedia',['{{ $media->id }}'])">
                    </span>
                @elseif($action === 'attachments')
                    <button type="button" class="btn btn-link text-danger p-0 float-right"
                        wire:click="removeMedia('{{ $media->id }}')"><i class="fas fa-times"></i></button>
                @elseif($action == 'media')
                    @if ($type == 'mine')
                        <div class="d-flex justify-content-between small">
                            <button wire:click="setEditMedia('{{ $media->id }}')" type="button"
                                class="btn text-light p-0" data-toggle="modal" data-target="#edit_media"><i
                                    class="fas fa-edit"></i></button>
                            <form action="{{ route('media.destroy', $media) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn text-danger p-0"><i
                                        class="fas fa-trash-alt"></i></button>
                            </form>
                        </div>
                    @else
                        <div class="small text-light">Shared By {{ $media->user->organization->name_short }}</div>
                    @endif
                @endif
            </div>
        </div>
    @endif
    <a href="{{ route('media.show', $media->uuid) }}" target="_blank">
        <div class="p-2 bg-light">
            <p class="text-dark mb-0" style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">
                {{ $media->name }}</p>
            <div class="d-flex align-items-center justify-content-between small">
                <span class="text-muted float-right">{{ getExtension($media->file_name) }}</span>
                <span class="text-muted float-right">{{ $media->created_at->diffForHumans() }}</span>
            </div>
            <hr>
            <div class="small text-secondary"><i class="fas fa-user"></i> {{ $media->user->email }}</div>
        </div>
    </a>
</div>
