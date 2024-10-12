<div>
    <div class="card-body">																	
        <div class="form-group" wire:ignore>                				  
            <select class="select2" multiple="multiple" data-placeholder="To:" style="width: 100%;" name="recipients[]" >		  	
            @foreach($users as $user)
                <option value = "{{$user->id}}">{{$user->email}} ({{$user->name}})</option>
            @endforeach
            </select>
        </div>
        <div class="form-group">
            <input wire:model.defer="draft.subject" class="form-control" placeholder="Subject:" name="subject" >
        </div>
        <div class="form-group">
            <style>
                .note-editable{
                    height:250px;
                }
            </style>
            <textarea id="compose-textarea" class="form-control" style="height:400px" name="body" >
                
            </textarea>
        </div>

        <div class="form-group">
            @include('mail.partials.attach-files-modal')
        </div>
    </div>

    <div class="card-footer">
        <div class="float-right">
            <button type="button" class="btn btn-default" ><i class="fas fa-pencil-alt"></i>Draft</button>
            <button type="submit" class="btn btn-primary"><i class="far fa-envelope"></i> Send</button>
        </div>
        <button type="reset" class="btn btn-default"><i class="fas fa-times"></i> Discard</button>
    </div>
</div>
