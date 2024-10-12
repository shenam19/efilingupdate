<div>
    <button type="button" class="btn btn-default btn-file" data-toggle="modal" data-target="#attach-files">
        <i class="fas fa-paperclip align-middle"></i> ཡིག་ཆ་མཉམ་སྦྱར་བྱོས།
    </button>

    <div wire:ignore  class="modal fade" id="attach-files" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ཡིག་ཆ་མཉམ་སྦྱར་བྱོས།
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="dropzone rounded" id="media-dropzone"></div>
                    <input type="hidden" id="media" wire:model="selected_media">
                </div>
                <div class="modal-body">
                    @livewire('show-media',['action'=>'attach'])
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">སྒོ་རྒྱག།</button>
                    <button type="button" class="btn btn-primary" wire:click="attach" onclick="closeAttachModal()">བསྒྱུར་བ་གསོག་འཇོག་བྱོས།</button>
                </div>
            </div>
        </div>
    </div>
    
    <!----- Selected Medias are shown as attachments ---->
    <ul class="mailbox-attachments d-flex mt-2">
        @foreach($attachments as $attachment)
            <li>
                @include('media.partials.single',['media'=>$attachment,'action' => 'attachments'])
            </li>
        @endforeach
        <input type="hidden" name="media" value="{{ implode(',',$selected_media)}}">
    </ul>

    @push('styles')
    <link rel="stylesheet" href="{{ asset('vendor/dropzone/dropzone.min.css')}}" type="text/css" />
    @endpush

    @push('scripts')
        <script src="{{ asset('vendor/dropzone/dropzone.min.js')}}"></script>
        <script>
            function closeAttachModal()
            {
                $('#attach-files').modal('hide')
            }
           
            const input = document.getElementById("media");
            var arr = [];
            Dropzone.options.mediaDropzone = { 
                paramName: "file", 
                maxFilesize: 16, // MB
                acceptedFiles: ".png,.jpg,.jpeg,.pdf,.doc,.docx,.xlsx,.xls",
                method: "POST",
                clickable: true,
                url: "{{route('media.store')}}",
                //sending csrf token
                sending: function(file, xhr, formData) {
                    formData.append("_token", "{{ csrf_token() }}");
                },
                accept: function(file, done) {
                    console.log("A file has been added");
                    done();
                },
                success:function(file, response) {
                    arr.push(response.payload);
                    input.value = arr;
                    Livewire.emitTo("attach-media", "setSelectedMedia", arr);
                },
                error(file, message) {
                    file.previewElement.classList.add("dz-error");
                    toastr.error("Error! Couldn't upload file!");
                },
            };
        </script>
    @endpush
</div>
