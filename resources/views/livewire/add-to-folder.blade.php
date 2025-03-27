<div wire:ignore class="modal fade" id="addToFolder" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-md  modal-dialog-centered" role="document">
        <div class="modal-content rounded-0">
            <div class="modal-body py-0">
                <div class="d-block main-content px-2 py-4">
                    <div class="content-text">
                        <h5 class="mb-2">Add the selected messages to folder</h5>
                        <div class="my-3">
                            <x-dropdown :option="$fileTree" id="fileSelect" :multiple="true" placeholder="འདེམས།"
                                v-on:select="selectData" v-on:deselect="unsetData" />
                            @error('folders')
                                <span class="text-danger small">*{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="d-flex">
                            <div class="ml-auto">
                                <button class="btn btn-link" data-dismiss="modal">Cancel</button>
                                <button class="btn btn-default" wire:click="addToFolder" data-dismiss="modal">Add To
                                    Selected Folder</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
