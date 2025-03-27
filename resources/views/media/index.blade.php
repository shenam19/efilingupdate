<x-app-layout>
    <x-header>
        ཡིག་པར།
    </x-header>
    <div class="container-fluid">

        <form id="media-dropzone" class="dropzone needsclick" action="{{ route('media.store') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div class="dz-message needsclick">
                <h1><i class="fas fa-upload"></i></h1>
                ཡིག་པར་རྣམས་འདིར་ཡར་འཇུག་བྱོས།
                <span class="note needsclick"></span>
            </div>
        </form>

        <div class="row">
            <div class="col-12">
                @livewire('show-media', ['action' => 'media'])
            </div>
        </div>

    </div>

    @push('styles')
        <link rel="stylesheet" href="{{ asset('vendor/dropzone/dropzone.min.css') }}" type="text/css" />
    @endpush

    @push('scripts')
        <script src="{{ asset('vendor/dropzone/dropzone.min.js') }}"></script>
        <script>
            Dropzone.options.mediaDropzone = { // camelized version of the `id`
                paramName: "file", // The name that will be used to transfer the file
                maxFilesize: 50, // MB
                acceptedFiles: ".png,.jpg,.jpeg,.pdf,.doc,.docx,.xlsx",
                accept: function(file, done) {
                    console.log("A file has been added");
                    return done();
                },
                success: function(file, response) {
                    // Livewire.emitTo("show-media","refresh");
                    // Livewire.dispatch("refresh").to("show-media");
                    Livewire.dispatchTo("show-media", "refresh");

                },
                error(file, message) {
                    if (file.previewElement) {
                        if (typeof message !== "string" && message.error) {
                            message = message.error;
                        }
                        for (let node of file.previewElement.querySelectorAll(
                                "[data-dz-errormessage]"
                            )) {
                            node.textContent = message;
                        }
                    }
                    toastr.warning("Error! Couldn't upload file!");
                },

            };
        </script>
    @endpush

</x-app-layout>
