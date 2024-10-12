<div class="float-right">
    <button class="btn float-right p-0 ml-2" data-target="#readStatus_{{$message_id}}" data-toggle="modal">
        <i class="fas fa-check {{ $not_read ? 'text-secondary' : 'text-primary'}}"></i>
    </button>
    <div class="modal fade" id="readStatus_{{$message_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body pb-0">
                    <button type="button" class="close float-right" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    
                <div class="modal-body">
                    <ul class="list-group">
                        @foreach($recipients as $recipient)
                        <li class="list-group-item d-flex align-items-center justify-content-between">
                            <div>
                                @if($recipient->last_read)
                                    <i class="fas fa-check text-primary mr-2"></i> 
                                @else
                                   <i class="fas fa-times text-danger mr-2"></i>
                                @endif
                                {{ $recipient->is_user ? $recipient->user->name : $recipient->contact->name}}
                            </div>
                            <span class="small text-secondary">{{$recipient->last_read ? Carbon\Carbon::parse($recipient->last_read)->diffForHumans() : 'Not Read'}}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

