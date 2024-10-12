<div class="float-right">
    <button class="btn float-right p-0 mx-2 {{count($folders) ? 'text-primary' : 'text-secondary'}}" @if(count($folders)) data-target="#folderStatus_{{$message->id}}" data-toggle="modal" @endif>
        <i class="fas fa-folder-open"></i>
    </button>

    <div class="modal fade" id="folderStatus_{{$message->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body pb-0">
                    <button type="button" class="close float-right" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    
                <div class="modal-body">
                    <ul class="list-group">
                        @foreach($folders as $folder)
                        <li class="list-group-item d-flex align-items-center justify-content-between">
                            <div>
                                
                                <i class="fas fa-folder text-dark mr-2"></i> 
                                {{$folder->file_no.' '.$folder->name}}
                            </div>
                            <span class="small text-secondary">{{$folder->pivot->created_at}}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

