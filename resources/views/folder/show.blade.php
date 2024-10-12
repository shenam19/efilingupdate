<x-app-layout>
   <x-header>
        {{$folder->name}}
        <x-slot name="create_button">
            <button type="button" class="btn btn-info btn-flat" data-toggle="modal" data-target="#folderCreate">
               <i class="fas fa-folder-plus align-middle"></i>
               Create Folder
            </button>
        </x-slot>
    </x-header>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            @livewire('folder.display-folders',['folders'=>$folder->subfolders])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!------- Folder Creation Modal -------------->
    <div class="modal fade" id="folderCreate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Folder</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('folders.store')}}">
                    @csrf
                    <input type="hidden" value="{{$folder->id}}" name="parent">
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="col-4">
                                <label>སྡེ་ཚན། <span class="text-danger">*</span></label>
                                <div id="orgTreeSelectAdd">
                                    <treeselect v-model="value" :multiple="false" :options="options" name="works_at" required />
                                </div>
                                </select>
                            </div>
                            <div class="col-4">
                                <label>Date Opened</label>
                                <input type="date" class="form-control" placeholder="འདིར་བྲི་རོགས།" name="date_opened"
                                value="{{ old('date_opened') }}">
                            </div>

                            <div class="col-4">
                                <label>ཡིག་སྣོད་ཨང། <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('file_no') is-invalid @enderror" placeholder="འདིར་བྲི་རོགས།" name="file_no"
                                value="{{ old('file_no') }}"
                                required>
                                @error('subject')
                                    <div class="text-danger font-italic" style="font-size:0.8rem">*{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-8">
                                <label>ཡིག་སྣོད་མིང། <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('file_name') is-invalid @enderror" placeholder="འདིར་བྲི་རོགས།" name="file_name"
                                value="{{ old('file_name') }}"
                                required>
                                @error('subject')
                                    <div class="text-danger font-italic" style="font-size:0.8rem">*{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-4">
                                <label>Type</label><br>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadioInline1" name="type" value="general" class="custom-control-input" checked>
                                    <label class="custom-control-label font-weight-normal" for="customRadioInline1">General</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadioInline2" name="type" value="subject-file" class="custom-control-input">
                                    <label class="custom-control-label font-weight-normal" for="customRadioInline2">Subject File</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push("scripts")
    <script>
        // register the component
        Vue.component('treeselect', VueTreeselect.Treeselect)
        new Vue({
            el: '#orgTreeSelectAdd',
            data: {
                // define the default value
                value: null,
                // define options
                options: {!!$sections!!},
            },
        });

        Livewire.on('EditFile', msg => {
            // register the component
            Vue.component('treeselect', VueTreeselect.Treeselect)
            new Vue({
                el: '#orgTreeSelectEdit',
                data: {
                    // define the default value
                    value: null,
                    // define options
                    options: {!!$sections!!},
                },
            });
        });
    </script>
    @endpush
</x-app-layout>