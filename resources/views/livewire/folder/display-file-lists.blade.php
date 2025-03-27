<div>
    <div class="form-row">
        <div class="col">
            <input type="text" wire:model.live="filename" class="form-control"
                placeholder="ཡིག་ཁུག་གི་ཨང་གྲངས་ཡང་ན་མིང་ནས་འཚོལ།">
        </div>
    </div>
    @if (auth()->user()->hasRole(['admin', 'front desk']))
        <div class="form-row mt-1">
            <div class="col" wire:ignore>
                <x-dropdown :option="$sections" name="sections" id="sectionSearchSelect" :multiple="false" :multiSelect="0"
                    placeholder="Select Section" v-on:input="setSection" />
            </div>
        </div>
    @endif
    <hr>

    @includeWhen($search, 'folder.partials.search-list')
    @includeWhen(!$search, 'folder.partials.file-list')

    <div id="deleteFileModal" class="modal fade" wire:ignore>
        <div class="modal-dialog modal-confirm">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="icon-box">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this file along with all its subfolders? This process cannot be
                        undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" wire:click="deleteFile()"
                        data-dismiss="modal">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>
