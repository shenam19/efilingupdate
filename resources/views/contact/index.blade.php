<x-app-layout>
    <x-header>
        འབྲེལ་གཏུགས་ཁ་བྱང་།
    </x-header>
    <section class="content">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">འབྲེལ་གཏུགས།</h3>
                        <div class="text-right">
                            <a href="#create_contact_modal" class="btn btn-primary " data-toggle="modal">
                                <i class="fas fa-plus align-middle"></i> <span>འབྲེལ་གཏུགས་གསར་བཟོ་བྱོས།</span></a>
                        </div>
                    </div>
                    <div class="card-body d-flex flex-wrap">
                        <x-dropdown :option="$contactsTree" name="contact" id="contactSelect" :multiple="false"
                            :multiSelect="0" placeholder="འབྲེལ་ཡུལ་བདམས་ཏེ་བཟོ་བཅོས་བྱོས།"
                            v-on:select="selectionChange" />
                    </div>

                    @livewire('show-contact-card')
                    <div class="card-footer">
                        <div class="mailbox-controls">
                            <div class="float-right">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    <!-- Add Modal HTML -->
    <div class="modal fade" id="create_contact_modal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ route('contact.store') }}">
                    @csrf
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
                                        <input type="text" class="form-control" name="name"
                                            value="{{ old('name') }}" required>
                                    </div>
                                    @error('name')
                                        <div class="text-danger font-italic" style="font-size:0.8rem">*{{ $message }}
                                        </div>
                                    @enderror
                                </div>

                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>གློག་འཕྲིན།/Email</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="email"
                                            value="{{ old('email') }}">
                                    </div>
                                    @error('email')
                                        <div class="text-danger font-italic" style="font-size:0.8rem">*{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>ཁ་པར་ཨང་གྲངས།</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="phone"
                                            value="{{ old('phone') }}">
                                    </div>
                                    @error('phone')
                                        <div class="text-danger font-italic" style="font-size:0.8rem">*{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>སྡེ་ཁུངས།</label>
                                    <x-dropdown :option="$contactsTree" name="parent_id" id="groupSelect" :multiple="false"
                                        :multiSelect="0" placeholder="སྡེ་ཁུངས།.." />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>ཁ་བྱང་།</label>
                            <div class="input-group">
                                <textarea class="form-control" name="address" value="{{ old('address') }}"></textarea>
                                @error('address')
                                    <div class="text-danger font-italic" style="font-size:0.8rem">*{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ཁ་རྒྱོབས།</button>
                        <button type="submit" class="btn btn-primary">གསོག་འཇོག་བྱོས།</button>
                    </div>
                </form>
            </div>

        </div>

    </div>
    @push('scripts')
        <script type="text/javascript">
            $(document).ready(function() {
                @if (count($errors) > 0)
                    $('#create_contact_modal').modal('show');
                @endif
            });
        </script>
    @endpush
</x-app-layout>
