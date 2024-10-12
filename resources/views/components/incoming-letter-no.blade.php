
    <div class="col-3">
        <div class="form-group">
            <label>ནང་འབྱོར་ཡི་གེའི་ཨང་གྲངས།</label>
            <input type="number" class="input-group-text text-left form-control" name="record[incoming_no]"
                value="{{$incomingNo}}">
        </div>
    </div>
    <div class="col-4">
        <div class="form-group">
            <label>ཡི་གེའི་ཨང་གྲངས།</label>
            <input type="text" class="form-control" placeholder="ཡི་གེའི་ཨང་གྲངས།" name="record[letter_number]"
                value="{{ $outgoingWord ?? old('record.letter_number') }}">
        </div>
    </div>

@error('record.letter_number')
<div class="text-danger font-italic" style="font-size:0.8rem">
    *{{ $message }}</div>
@enderror
@error('record.incoming_no')
<div class="text-danger font-italic" style="font-size:0.8rem">
    *{{ $message }}</div>
@enderror