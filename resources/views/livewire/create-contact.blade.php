<div>
    <div class="row mb-3">
        <div class="col-8">
            <div class="form-group">
                <label>{{$type === 'incoming' ? 'གཏོང་མཁན།' : 'ཕྱི་ལ་གཏོང་ཡུལ།'}}</label><span class="text-danger">*</span>
                @if($type === 'incoming')
                    <x-dropdown 
                        :option="$contactsTree" 
                        name="recipients" 
                        id="contactSelect" 
                        :multiple="false" 
                        :multiSelect="0"
                        placeholder="འདེམས།"                        
                        :selected=$selected
                    /> 
                @else
                    <x-dropdown 
                        :option="$contactsTree" 
                        name="recipients[]" 
                        id="contactSelect" 
                        :multiple="true" 
                        placeholder="འདེམས།"
                        :selected=$selected
                    /> 
                @endif
                @error('recipients')
                <div class="text-danger font-italic" style="font-size:0.8rem">*{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-4 align-self-center">
            <button type="button" class="mt-3 rounded btn btn-info" data-toggle="modal"
                data-target="#create_org_modal"><i class="fa fa-user-plus align-middle"></i>
                ཕྱིའི་སྒྲིག་འཛུགས་གསར་པ་ཆུགས།</button>
        </div>
    </div>

    <!----- create contact modal --------->
    <div wire:ignore class="modal fade" id="create_org_modal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">
                        ཕྱིའི་སྒྲིག་འཛུགས་གསར་པ་ཆུགས།</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>མིང་།</label><span class="text-danger">*</span>
                                <div class="input-group">
                                    <input type="text" class="form-control" wire:model.defer="contact.name">
                                </div>
                            </div>
                            @error('contact.name')
                            <div class="text-danger font-italic" style="font-size:0.8rem">*{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>གློག་འཕྲིན།/Email</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" wire:model.defer="contact.email">
                                </div>
                            </div>
                            @error('contact.email')
                            <div class="text-danger font-italic" style="font-size:0.8rem">*{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>ཁ་པར་ཨང་གྲངས</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" wire:model.defer="contact.phone">
                                </div>
                            </div>
                            @error('contact.phone')
                            <div class="text-danger font-italic" style="font-size:0.8rem">*{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>ཚོགས་སྡེ་གང་གི་ཁུངས།</label>                                
                                <x-dropdown 
                                    :option="$contactsTree" 
                                    id="groupSelect" 
                                    :multiple="false" 
                                    placeholder="འདེམས།" 
                                    :multiSelect="0"
                                    v-on:select="setParentContact"
                                    v-on:deselect="removeParentContact"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>ཁ་བྱང་།</label>
                        <div class="input-group">
                            <textarea class="form-control" wire:model.defer="contact.address">
                            </textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">སྒོ་རྒྱག</button>
                    <!-- <button type="button" class="btn btn-primary" data-dismiss="modal" wire:click="createContact">གསོག་འཇོག</button> -->
                    <button type="button" class="btn btn-primary" data-dismiss="modal"
                        wire:click="createContact">གསོག་འཇོག</button>
                </div>
            </div>
        </div>

    </div>

    @push('scripts')
    <script>
        Livewire.on('addedUser',(options, select) => {
            contactSelect.options = options;
            groupSelect.options = options;
            groupSelect.value = null;
            const recipients = new Set(contactSelect.value);

            @if($type === 'incoming')
                contactSelect.value = null;
                contactSelect.value = select.id;
                console.log(contactSelect.value);
            @else
                recipients.add(select.id);
                contactSelect.value = Array.from(recipients);
                //contactSelect.value = Arraypush(select.id);
                console.log(contactSelect.value);
            @endif
        });
    </script>
    @endpush
</div>
