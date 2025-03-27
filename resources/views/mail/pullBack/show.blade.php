<x-app-layout>
    <x-header>
        ནོར་བཅོས་གྱིས།
    </x-header>
    <!-- Main content -->
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <div data-toggle="tooltip" data-placement="top" title="Pullback Request">
                                {{ __('འཕྱིར་ཐེན་རེ་སྐུལ།') }}
                            </div>
                        </h3>
                    </div>
                    <form method="POST" action="{{ route('pullback.send') }}">
                        @csrf
                        <input type="hidden" name="oldMessage" value="{{ $message->id }}">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="reason-text">
                                            བཏང་ཟིན་པའི་གནས་ཕྲིན་ཞིག་འགྲིག་མིན་བྱུང་ཚེ་ཆུ་ཚོད་༢༤
                                            ནང་ཚུན་ཕྱིར་འཐེན་བྱ་འཐུས།
                                        </label><span class="text-danger">*</span>
                                        <textarea name="reason" class="form-control" id="reason-text" placeholder="ཕྱིར་འཐེན་བྱེད་དགོས་པའི་རྒྱུ་མཚན་འགོད་རོགས།"
                                            value="{{ old('reason') }}" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-9">
                                    <div class="form-group">
                                        <label for="composeSelect2">བསྐུར་ཡུལ།</label>

                                        <x-dropdown :option="$recipients" name="recipients[]" id="recipientSelect"
                                            :multiple="true" placeholder="བསྐུར་ཡུལ།.." :selected="$message->recipients->pluck('user_id')->toArray()" />
                                        @error('recipients')
                                            <div class="text-danger font-italic" style="font-size:0.8rem">
                                                *{{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="message_type_dd">ཡི་གེའི་དབྱེ་བ།</label>

                                        <select id="message_type_dd" name="message_type_id" class="form-control">
                                            @foreach ($messageTypes as $mType)
                                                <option value={{ $mType->id }}>{{ $mType->name_tibetan }}</option>
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
                                            <input id="allOfficeCheckbox" class="form-check-input" type="checkbox">
                                            <label for="allOfficeCheckbox">ལས་ཁུང་ཆ་ཚང་འདེམས།</label>
                                        </span>
                                        <span class="custom-checkbox">
                                            <input id="allColleagueCheckbox" type="checkbox">
                                            <label for="allColleagueCheckbox">ལས་རོགས་ཆ་ཚང་འདེམས།</label>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>ཡིག་ཁུག</label>
                                        <x-dropdown :option="$fileTree" name="folder[]" id="fileSelect" :multiple="true"
                                            placeholder="འདེམས།" :selected="$message->folders->pluck('id')->toArray()" />
                                    </div>
                                </div>

                                <div class="col-6">
                                    <x-subject />
                                </div>
                                <div class="col-3">
                                    <!-- <x-outgoing-letter-no :outgoingNo="$message->record->outgoing_no" :outgoingWord="$message->record->outgoing_word"/> -->
                                    <div class="form-group">
                                        <label>ཕྱིར་བཏང་ཡི་གེའི་ཨང་གྲངས།</label>
                                        <div class="input-group mb-2 mr-sm-2">
                                            <div class="input-group-prepend" style="width:40%">
                                                <input type="number" class="input-group-text form-control"
                                                    name="record[outgoing_no]"
                                                    value="{{ $message->record->outgoing_no }}" disabled>
                                            </div>
                                            <input id="letterNumber" type="text" class="form-control"
                                                placeholder="ཡི་གེའི་ཨང་གྲངས།" name="record[letter_number]"
                                                value="{{ isset($message->record->outgoing_word) ? $message->record->outgoing_word : old('record.letter_number') }}">

                                            @error('record.letter_number')
                                                <div class="text-danger font-italic" style="font-size:0.8rem">
                                                    *{{ $message }}</div>
                                            @enderror
                                            @error('record.outgoing_no')
                                                <div class="text-danger font-italic" style="font-size:0.8rem">
                                                    *{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        @livewire('attach-media', ['message' => $message])
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label>ཟུར་མཆན།</label>
                                        <textarea id="remarks" class="form-control" rows="3" placeholder="འདིར་འབྲི་རོགས།" name="remarks"
                                            value="kjhasdf">{{ old('remarks') }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="urgency">གལ་འགངས།</label>
                                        <select class="form-control" name="urgency" id="urgency">
                                            <option value="gray" @if ($message->urgency === 'gray') selected @endif>
                                                གལ་ཆུང་བ།</option>
                                            <option value="yellow" @if ($message->urgency === 'yellow') selected @endif>
                                                གལ་འབྲིང་བ།</option>
                                            <option value="orange" @if ($message->urgency === 'orange') selected @endif>
                                                གལ་ཆེ་བ།</option>
                                            <option value="red" @if ($message->urgency === 'red') selected @endif>
                                                ཛ་དྲག</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <label for="urgency">སྐད་ཡིག།</label>
                                    <select class="form-control" name="record[language]">
                                        <option @if ($message->record->language === 'བོད་ཡིག།') selected @endif>བོད་ཡིག།</option>
                                        <option @if ($message->record->language === 'ཨིན་ཡིག') selected @endif>ཨིན་ཡིག</option>
                                        <option @if ($message->record->language === 'ཧིནྡཱི།') selected @endif>ཧིནྡཱི།</option>
                                        <option @if ($message->record->language === 'གཞན།') selected @endif>གཞན།</option>
                                    </select>
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
                            <button id="discard" type="reset" class="btn btn-default"
                                onclick="location.href='{{ route('show', $message->uuid) }}';">
                                <i class="fas fa-times align-middle"></i>
                                དོར།
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#subject').val("{{ $message->subject }}");
                $('#remarks').val("{{ $message->remarks }}");
                $('#message_type_dd').val("{{ $message->message_type_id }}")

                let picked = {{ $message->recipients->pluck('user_id') }};
                $('#composeSelect2 option').each(function() {
                    if (picked.includes(parseInt($(this).val()))) {
                        $(this).attr("selected", "selected");
                    }
                });
                $('#composeSelect2').trigger('change');
                @if (isset($letterNumber))
                    $('#letterNumber').val("{{ $letterNumber }}");
                @endif
                $("#allOfficeCheckbox").change(function() {
                    if (this.checked === true) {
                        $(".office").attr("selected", "selected");
                        $('#composeSelect2').trigger('change');
                    } else {
                        $(".office").removeAttr("selected");
                        $('#composeSelect2').trigger('change');
                    }
                });
                $("#allColleagueCheckbox").change(function() {
                    if (this.checked === true) {
                        $(".colleague").attr("selected", "selected");
                        $('#composeSelect2').trigger('change');
                    } else {
                        $(".colleague").removeAttr("selected");
                        $('#composeSelect2').trigger('change');
                    }
                });
            });
        </script>
    @endpush
</x-app-layout>
