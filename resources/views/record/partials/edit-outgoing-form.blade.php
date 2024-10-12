<form method="POST" action="{{route('record.update',['type'=>$type,'message'=>$message])}}" enctype='multipart/form-data'>
    @method('PATCH')
    @csrf
    <div class="card-body">
        <div class="form-row">
            <div class="col-4">
                <x-outgoing-letter-no :outgoingNo="$message->record->outgoing_no" :outgoingWord="$message->record->outgoing_word"/>
            </div>
                                      
            <div class="col-3">
                <div class="form-group">
                    <label>སྡེ་ཚན།</label>   
                    <x-section-tree-dropdown id="orgTreeSelectAdd" :orgs="$orgChart" name="section" :selected="$message->organization_id"/>                                  
                </div>
            </div>

            <div class="col-3">
                <div class="form-group">
                    <label>བཏང་ཚེས།</label>
                    <span class="text-danger">*</span>
                    <div class="input-group date">
                        <input type="datetime-local" class="form-control" name="record[dispatched_date]"
                            value="{{ old('record[dispatched_date]',date('Y-m-d', strtotime($message->record->dispatched_date))) }}"
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
                        <option value={{ $mType->id }} @if($mType->id === $message->message_type_id) selected @endif>{{ $mType->name_tibetan }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="col-4">
                <div class="form-group">
                    <label>ལས་ཁུང་བསྐུར་ཡུལ།</label>
                    <x-dropdown 
                        :option="$frontDesks" 
                        name="internalRecipients[]" 
                        id="recipientSelect" 
                        :multiple="true" 
                        placeholder="བསྐུར་ཡུལ།.." 
                        :selected="$message->recipients()->where('is_user','1')->pluck('id')->toArray()"
                    />
                </div>
            </div>
            <div class="col">
                @livewire('create-contact',['type'=>$type, 'selected'=>$message->recipients()->where('is_user','0')->pluck('contact_id')->toArray()])
            </div>
        </div>

        <div class="row">
            <div class="col-12 d-flex align-items-end">
                @livewire('attach-media',['message'=>$message])
            </div>
        </div>

        <div class="form-row">
            <div class="col-2">
                <div class="form-group">
                    <label for="urgency">གལ་འགངས།</label>
                    <select class="form-control" name="urgency" id="urgency">
                        <option value="gray"   @if($message->urgency==='gray') selected @endif>ཆུང་བ།</option>
                        <option value="yellow" @if($message->urgency==='yellow') selected @endif>འབྲིང་བ།</option>
                        <option value="orange" @if($message->urgency==='orange') selected @endif>ཆེ་བ།</option>
                        <option value="red"    @if($message->urgency==='red') selected @endif>ཛ་དྲག</option>
                    </select>
                </div>
            </div>
            <div class="col-10">
                <div class="form-group">
                    <label>ནང་དོན།</label><span class="text-danger">*</span>
                    <input type="text" class="form-control @error('subject') is-invalid @enderror"
                        placeholder="འདིར་འབྲི་རོགས།" name="subject" value="{{ old('subject',$message->subject) }}"
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
                        name="remarks">{{ old('remarks',$message->remarks) }}</textarea>
                </div>
            </div>
        </div>

        <div class="form-row">

            <div class="col-4">
                <label>ཡིག་སྣོད།</label>
                <x-dropdown 
                    :option="$fileTree" 
                    name="folder[]" 
                    id="fileSelect" 
                    :multiple="true" 
                    placeholder="ཡིག་སྣོད།.." 
                    :selected="$message->folders()->pluck('id')->toArray()"
                />
            </div>

            <div class="col-4">
                <label>རྣམ་པ།</label>
                <select class="form-control" name="record[mode]">
               	    <option @if($message->record->mode === "ལག་ཏུ་བསྐུར།") selected @endif>ལག་ཏུ་བསྐུར།</option>
                    <option @if($message->record->mode === "སྦྲག་ཡིག/Post") selected @endif>སྦྲག་ཡིག/Post</option>
                    <option @if($message->record->mode === "མྱུར་སྦྲག/Speed post") selected @endif>མྱུར་སྦྲག/Speed post</option>
                    <option @if($message->record->mode === "དེབ་སྐྱེལ་སྦྲག་ཡིག/Register post") selected @endif>དེབ་སྐྱེལ་སྦྲག་ཡིག/Register post</option>
                    <option @if($message->record->mode === "ཀོོ་རི་ཡར།/Courier") selected @endif>ཀོོ་རི་ཡར།/Courier</option>
                    <option @if($message->record->mode === "གློག་འཕྲིན།/Email") selected @endif>གློག་འཕྲིན།/Email</option>
                    <option @if($message->record->mode === "ཕེགས།/Fax") selected @endif>ཕེགས།/Fax</option>
                    <option @if($message->record->mode === "གཞན།") selected @endif>གཞན།</option>
                </select>
            </div>

            <div class="col-4">
                <label>སྐད་ཡིག</label>
                <select class="form-control" name="record[language]">
                    <option @if($message->record->language === "བོད་ཡིག།"  ) selected @endif>བོད་ཡིག།</option>
                    <option @if($message->record->language === "ཨིན་ཡིག"  ) selected @endif>ཨིན་ཡིག</option>
                    <option @if($message->record->language === "ཧིནྡཱི།"  ) selected @endif>ཧིནྡཱི།</option>
                    <option @if($message->record->language === "གཞན།"  ) selected @endif>གཞན།</option>
                </select>
            </div>
        </div>

    </div>

    <div class="card-footer">
        <div class="float-right">
            <button type="submit" class="btn btn-primary" name="status" value="sent"><i
                    class="far fa-envelope px-1 align-middle"></i>གསོག་འཇོག་བྱོས།</button>
        </div>
    </div>

</form>
