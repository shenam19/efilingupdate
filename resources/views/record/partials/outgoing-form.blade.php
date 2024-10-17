<form method="POST" action="{{route('record.store',$type)}}" enctype='multipart/form-data' id="recordStoreForm">
    @csrf
    <div class="card-body">
        <div class="form-row">
            <div class="col-4">
                <x-outgoing-letter-no :outgoingNo="$register"/>
            </div>

            <div class="col-3">
                <div class="form-group">
                    <label>སྡེ་ཚན།</label>
                    <x-section-tree-dropdown id="orgTreeSelectAdd" :orgs="$orgChart" name="section"/>
                </div>
            </div>

            <div class="col-3">
                <div class="form-group">
                    <label>བཏང་ཚེས།</label>
                    <span class="text-danger">*</span>
                    <div class="input-group date">
                        <input type="datetime-local" class="form-control" name="record[dispatched_date]"
                            value="{{ old('record[dispatched_date]',Carbon\Carbon::now()) }}"
                            required>
                    </div>
                    @error('record.dispatched_date')
                    <div class="text-danger font-italic" style="font-size:0.8rem">*{{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="col-2">
                <div class="form-group">
                    <label for="message_type_dd">ཡི་གེའི་དབྱེ་བ།</label>
                    <select id="message_type_dd" name="message_type_id" class="form-control">
                        @foreach($messageTypes as $mType)
                        <option value={{ $mType->id }}>{{ $mType->name_tibetan }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="col-4">
                <div class="form-group">
                    <label>ནང་ཁུལ་གཏོང་ཡུལ།</label>
                    <x-dropdown
                        :option="$frontDesks"
                        name="internalRecipients[]"
                        id="recipientSelect"
                        :multiple="true"
                        placeholder="བསྐུར་ཡུལ།.."
                    />
                </div>
            </div>
            <div class="col">
                @livewire('create-contact',compact('type'))
            </div>
        </div>

        <div class="row">
            <div class="col-12 d-flex align-items-end">
                @livewire('attach-media')
            </div>
        </div>

        <div class="form-row">
            <div class="col-2">
                <div class="form-group">
                    <label for="urgency">གལ་འགངས།</label>
                    <select class="form-control" name="urgency" id="urgency">
                        <option value="gray">ཆུང་བ།</option>
                        <option value="yellow">འབྲིང་བ།</option>
                        <option value="orange">ཆེ་བ།</option>
                        <option value="red">ཛ་དྲག</option>
                    </select>
                </div>
            </div>
            <div class="col-10">
                <div class="form-group">
                    <label>ནང་དོན།</label><span class="text-danger">*</span>
                    <input type="text" class="form-control @error('subject') is-invalid @enderror"
                        placeholder="འདིར་འབྲི་རོགས།" name="subject" value="{{ old('subject') }}"
                        required>
                    @error('subject')
                    <div class="text-danger font-italic" style="font-size:0.8rem">*{{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col">
                <div class="form-group">
                    <label>ཟུར་མཆན།</label>
                    <textarea class="form-control" rows="3" placeholder="འདིར་འབྲི་རོགས།"
                        name="remarks">{{ old('remarks') }}</textarea>
                </div>
            </div>
        </div>

        <div class="form-row">

            <div class="col-4">
                <label>ཡིག་ཁུག</label>
                <x-dropdown :option="$fileTree" name="folder[]" id="fileSelect" :multiple="true" placeholder="འདེམས།"/>
            </div>

            <div class="col-4">
                <label>རྣམ་པ།</label>
                <select class="form-control" name="record[mode]">
		    <option>ལག་ཏུ་བསྐུར།</option>
                    <option>གློག་འཕྲིན།/Email</option>
                    <option>སྦྲག་ཡིག/Post</option>
                    <option>མྱུར་སྦྲག/Speed post</option>
                    <option>དེབ་སྐྱེལ་སྦྲག་ཡིག/Register post</option>
                    <option>ཀོོ་རི་ཡར།/Courier</option>
                    <option>ཕེགས་/Fax</option>
                    <option>གཞན།</option>
		</select>
            </div>

            <div class="col-4">
                <label>སྐད་ཡིག</label>
                <select class="form-control" name="record[language]">
                    <option>བོད་ཡིག།</option>
                    <option>ཨིན་ཡིག</option>
                    <option>ཧིནྡཱི།</option>
                    <option>གཞན།</option>
                </select>
            </div>
        </div>

    </div>

    <div class="card-footer">
        <div class="float-right">
            <button type="submit" class="btn btn-primary" name="status" value="sent" id="submitButton"><i
                    class="far fa-envelope px-1 align-middle"></i>གསོག་འཇོག་བྱོས།</button>
        </div>
    </div>

</form>
<script src="{{ mix('js/formSubmissionHandler.js') }}"></script>
