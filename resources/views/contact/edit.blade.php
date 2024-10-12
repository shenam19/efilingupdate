<x-app-layout>
    <x-header>
        འབྲེལ་གཏུགས་ཁ་བྱང་།
    </x-header>
    <section class="content">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">འབྲེལ་གཏུགས་ཁ་བྱང་བཟོ་བཅོས།།</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('contact.update', $contact) }}">
                            @method('PATCH')
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>མིང་།</label><span class="text-danger">*</span>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="name"
                                                value="{{ $contact->name }}" required>
                                        </div>
                                        @error('name')
                                        <div class="text-danger font-italic" style="font-size:0.8rem">*{{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>སྤྱོད་མིང་ངོ་རྟགས།</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="email"
                                                value="{{ $contact->email }}">
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
                                                value="{{ $contact->phone }}">
                                        </div>
                                        @error('phone')
                                        <div class="text-danger font-italic" style="font-size:0.8rem">*{{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>ཚོགས་སྡེ་གང་གི་ཁུངས། </label>                                        
                                        <x-dropdown :option="$contactsTree" name="parent_id" id="groupSelect"
                                            :multiple="false" :multiSelect="0" placeholder="འདེམས།" :selected="$contact->parent_id"/>
                                        @error('parent_id')
                                        <div class="text-danger font-italic" style="font-size:0.8rem">*{{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>ཁ་བྱང་།</label>
                                <div class="input-group">
                                    <textarea class="form-control" name="address">{{ $contact->address}}</textarea>
                                    @error('address')
                                    <div class="text-danger font-italic" style="font-size:0.8rem">*{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    onclick="location.href='{{ route('contact.index')}}';">ཕྱིར་ལོག</button>
                                <button type="submit" class="btn btn-primary"> གསོག་འཇོག</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </section>
</x-app-layout>
