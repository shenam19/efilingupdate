<div class="float-right">
    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#forward"> 
        <div data-toggle="tooltip" data-placement="top" title="Forward">
            <i class="fas fa-share"></i> བརྒྱུད་བསྐུར་ཐོངས། 
        </div>
    </button>
        
    <div wire:ignore class="modal fade" id="forward" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true"  style="overflow-y:scroll">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header card-primary card-outline ">
                    <h5 class="modal-title" id="exampleModalLabel">Forward Message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <div class="form-row">
                        <div class= "col-12">
                            <div class="form-group">
                                <label>ནང་ཁུལ།</label>
                                <x-dropdown 
                                    :option="$internal" 
                                    id="colleagueSelect" 
                                    :multiple="true" 
                                    placeholder="འདེམས།"
                                    v-on:select="setRecipient"
                                    v-on:deselect="removeRecipient"
                                /> 
                                @error('recipients')
                                <div class="text-danger font-italic" style="font-size:0.8rem">*{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>  
                    
                    @livewire('attach-media')
                    
                    <div class="form-group">
                        <label>ཟུར་མཆན།</label>
                        <textarea class="form-control" rows="3" placeholder="འདིར་འབྲི་རོགས།"
                            wire:model="remarks">{{ old('remarks') }}</textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">དོར།</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal"
                        wire:click="forward">བརྒྱུད་བསྐུར་ཐོངས།</button>
                </div>
            </div>
        </div>
    </div>
</div>
