<div wire:ignore.self class="modal fade" id="showRecordLists" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-md  modal-dialog-centered" role="document">
        <div class="modal-content rounded-0">
            <div class="modal-body py-0">
                <div class="d-block main-content">
                    <div class="content-text px-2 py-4">
                        <h5 class="mb-2 text-dark">Select records to add to folder</h5>
                        <div class="list-group">
                            @forelse($messages as $message)
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <div class="d-flex flex-column text-secondary">
                                        <div class="text-dark">
                                            @if(in_array($message->organization_id,$orgs))                                            
                                                <i class="fas fa-arrow-up text-success"></i>
                                                {{ $message->getOutgoingLetterNo() }}                                             
                                            @else
                                                <i class="fas fa-arrow-down text-primary"></i>
                                                {{ $message->getIncomingNo($myOrgs) }}                                         
                                            @endif
                                        </div>
                                        <div class="small">{{ Illuminate\Support\Str::limit($message->subject,'60','..')}}</div>
                                    </div>
                                    <input type="checkbox" wire:model="selectedToAdd" value="{{$message->id}}">
                                </div>
                            @empty
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <div class="text-primary text-center">No Records Available!</div>
                                </div>
                            @endforelse
                        </div>
                        <div class="py-2 mx-auto">
                        {{$message_lists->links()}}
                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="ml-auto">
                                <button class="btn btn-link text-dark" data-dismiss="modal">Cancel</button>
                                <button data-dismiss="modal" class="btn btn-default text-dark" wire:click="addToFolder" {{$this->selectedToAddCount ? '' : 'disabled'}}>
                                    <i class="fas fa-folder-plus"></i> Add To Folder
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>