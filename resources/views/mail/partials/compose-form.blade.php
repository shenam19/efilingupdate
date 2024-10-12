<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        {{ __('གནད་དོན་གསར་པ་བྲིས།') }}
                    </h3>
                </div>
                @if($type === 'compose')
                <form method="POST" action="{{route('send')}}">

                    @else
                    <form method="POST" action="{{route('draft.send', $message)}}">
                        @method('PUT')
                    @endif
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-9">
                                    <div class="form-group">
                                        <label>བསྐུར་ཡུལ།</label><span class="text-danger">*</span>
                                        @if($type === 'draft')
                                            <x-dropdown 
                                                :option="$recipients" 
                                                name="recipients[]" 
                                                id="recipientSelect" 
                                                :multiple="true" 
                                                placeholder="བསྐུར་ཡུལ།"
                                                :selected="$message->recipients->pluck('user_id')->toArray()" 
                                            />
                                        @else
                                            <x-dropdown 
                                                :option="$recipients" 
                                                name="recipients[]" 
                                                id="recipientSelect" 
                                                :multiple="true" 
                                                placeholder="བསྐུར་ཡུལ།" 
                                            />
                                        @endif
                                        @error('recipients')
                                        <div class="text-danger font-italic" style="font-size:0.8rem">*{{ $message }}
                                        </div>
                                        @enderror
           
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="message_type_dd">འཕྲིན་ཐུང་དབྱེ་བ།</label>
                                    <select id="message_type_dd" name="message_type_id" class="form-control">
                                        @foreach($messageTypes as $mType)
                                        <option value={{ $mType->id }}>{{ $mType->label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <!-- checkbox -->
                                <div class="form-group d-flex flex-row justify-content-end">
                                    <span class="custom-checkbox mr-4">
                                        <input id="allOfficeCheckbox" class="form-check-input" type="checkbox" >
                                        <label for="allOfficeCheckbox">ལས་ཁུང་ཆ་ཚང་འདེམས།</label>
                                    </span>
                                    <span class="custom-checkbox">
                                        <input id="allColleagueCheckbox" type="checkbox">
                                        <label for="allColleagueCheckbox">ལས་རོགས་ཆ་ཚང་འདེམས།</label>
                                    </span>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>ཡིག་ཁུག</label>
                                        @if($type === 'draft')
                                            <x-dropdown 
                                                :option="$fileTree" 
                                                name="folder[]" 
                                                id="fileSelect" 
                                                :multiple="true" 
                                                placeholder="འདེམས།"  
                                                :selected="$message->folders->pluck('id')->toArray()" 
                                            />
                                        @else
                                            <x-dropdown 
                                                :option="$fileTree" 
                                                name="folder[]" 
                                                id="fileSelect" 
                                                :multiple="true" 
                                                placeholder="འདེམས།"  
                                            />
                                        @endif
                                    </div>
                                </div>
                                <div class="col-6">
                                    <x-subject/>                                    
                                </div>
                                <div class="col-3">
                                    <x-outgoing-letter-no :outgoingNo="$outgoing_no"/>

                        </div>
                        
                       
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">

                                    @if($type === 'compose')
                                    @livewire('attach-media')

                                    @else
                                    @livewire('attach-media',['message'=>$message])
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>ཟུར་མཆན།</label>
                                    <textarea id="remarks" class="form-control" rows="3"
                                        placeholder="འདིར་འབྲི་རོགས།" name="remarks">{{ old('remarks') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
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

                            <div class="col-2">
                                <div class="form-group">
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
                    </div>
                    <div class="card-footer">
                        <div class="float-right">
                            <button type="submit" name="status" value="sent" class="btn btn-primary">
                                <i class="far fa-envelope align-middle"></i>
                                ཐོངས།
                            </button>
                        </div>
                        <button id="discard" type="reset" class="btn btn-default">
                            <i class="fas fa-times align-middle"></i>
                            དོར།
                        </button>
                        <button type="submit" name="status" value="draft" class="btn btn-default">
                            <i class="far fa-file align-middle"></i>
                            ཟིན་བྲིས་གསོག་འཇོག་བྱོས།
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>