<div class="form-group">
    <label>ཕྱིར་བཏང་ཡི་གེའི་ཨང་གྲངས།</label>
    <div class="input-group mb-2 mr-sm-2">
        <div class="input-group-prepend" style="width:40%">
            <input type="number" class="input-group-text form-control" name="record[outgoing_no]"
                value="{{$outgoingNo}}">
        </div>
        <input id="letterNumber" type="text" class="form-control" placeholder="ཡི་གེའི་ཨང་གྲངས།"
            name="record[letter_number]"
            value="{{ isset($outgoingWord) ? $outgoingWord : old('record.letter_number') }}">

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