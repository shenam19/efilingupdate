<x-app-layout>
    <x-header>
    </x-header>

    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/message-table.css') }}">
    @endpush
    <div class="container-fluid px-4">
        <div class="row">
            <div class="col p-0">
                <div class="card-footer py-2">
                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#folderCreate"
                        onclick="resetParentId()">
                        <i class="fas fa-folder-plus" style="vertical-align:middle"></i> ཡིག་ཁུག་གསར་བཟོ་བྱོས།
                    </button>
                </div>
            </div>
        </div>

        @push('styles')
            <link rel="stylesheet" href="{{ asset('css/folder.css') }}">
        @endpush
        <div class="row" style="height:80vh">
            <div class="col-3 border h-100" style="overflow-y: scroll;">
                <div class="folder-structure d-flex flex-column justify-content-center py-2">
                    @livewire('folder.display-file-lists', compact('orgs', 'sections'))
                </div>
            </div>

            <!--- When a file is clicked, it will show its content on the right side -->
            @livewire('folder.show-folder-contents', compact('orgs', 'sections'))

        </div>
    </div>

    <!------- Folder Creation Modal -------------->
    <div class="modal fade" id="folderCreate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ཡིག་ཁུག་གསར་བཟོ་བྱོས།</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form method="POST" action="{{ route('folders.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-row">

                            <input id="parent_id" type="hidden"name="parent" value="">

                            <div class="col-4">
                                <label>སྡེ་ཚན།</label>
                                <x-section-tree-dropdown id="orgTreeSelectAdd" :orgs="$sections" name="works_at" />
                            </div>

                            <div class="col-4">
                                <label>བཟོས་ཚེས།</label>
                                <input type="date" class="form-control" placeholder="འདིར་བྲི་རོགས།"
                                    name="date_opened" value="{{ old('date_opened') }}">
                            </div>

                            <div class="col-4">
                                <label>ཡིག་སྣོད་ཨང་། <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('file_no') is-invalid @enderror"
                                    placeholder="འདིར་བྲི་རོགས།" name="file_no" value="{{ old('file_no') }}" required>
                                @error('subject')
                                    <div class="text-danger font-italic" style="font-size:0.8rem">*{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row mt-2">
                            <div class="col-8">
                                <label>ཡིག་སྣོད་མིང་། <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('file_name') is-invalid @enderror"
                                    placeholder="འདིར་བྲི་རོགས།" name="file_name" value="{{ old('file_name') }}"
                                    required>
                                @error('subject')
                                    <div class="text-danger font-italic" style="font-size:0.8rem">*{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-4">
                                <label>གནད་དོན་དབྱེ་བ།</label><br>
                                <div class="form-group  clearfix custom-radio">
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" name="type" value="general" checked>
                                        <label for="radioPrimary1">སྤྱི།</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-4">
                                        <input type="radio" name="type" value="subject-file">
                                        <label for="radioPrimary2">བྱེ་བྲག</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ཁ་རྒྱོབས།</button>
                        <input type="submit" class="btn btn-primary" value="འགོད་འབུལ་ཞུས།">
                    </div>
                </form>
            </div>
        </div>
    </div>


    @push('scripts')
        <script>
            $(".file-info").click(function() {
                $(".file-info").parent().removeClass('active');
                $(this).parent().addClass("active");
            })

            function myFunction() {
                if (confirm("Are you sure you want to delete this file and all its subfolders?") == true) {
                    Livewire.dispatch('deleteFile')
                    // Livewire.emit('deleteFile')
                }
            }

            function setParentId(id) {
                $("#parent_id").val(id);
            }

            function resetParentId() {
                $("#parent_id").val('');
            }

            function removeConfirm() {
                if (confirm("Are you sure you want to remove selected records from the file?") == true) {
                    // Livewire.emit('detachRecord')
                    Livewire.dispatch('detachRecord')
                }
            }
        </script>
    @endpush
</x-app-layout>
