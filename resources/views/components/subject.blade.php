<div class="form-group">
    <label for="subject">ནང་དོན།</label><span class="text-danger">*</span>
    <textarea id="subject" class="form-control" rows="1" placeholder="ནང་དོན།" name="subject"
        value="{{ old('subject') }}"></textarea>
</div>
@error('subject')
<div class="text-danger font-italic" style="font-size:0.8rem">
    *{{ $message }}</div>
@enderror