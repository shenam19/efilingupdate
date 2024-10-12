<div class="card-body p-0" >
    <small>-------- Forwarded Message ---------</small>
    @foreach($thread->messages as $message)
        <div class="mailbox-read-info small" style="border:none">
            <div class="">From: {{$message->sender->name}} {{$message->organization->name_short}}</div>
            <div> Date: {{ $message->record ? dateString($message->record->receieved_date) : dateString($message->created_at)}}</div>
            <div>Subject: {{$message->thread->subject}}</div>
            <div class="" style="font-size:14px">
                To: @foreach($message->recipients as $recipient)
                    {{$recipient->user->name}}{{$loop->last ? '' : ','}}
                @endforeach
            </div>
        </div>

        <div class="mailbox-read-message" >
            {{ $message->remarks }}
        </div>

        @if($message->attachments->count())
        <div class="card-footer bg-white">
            <ul class="mailbox-attachments d-flex align-items-stretch clearfix pt-2">
                @foreach($message->attachments as $attachment)
                    <li>
                        @include('media.partials.single',['media'=>$attachment])
                    </li>
                @endforeach
            </ul>
        </div>
        @endif
        
        @includeWhen($message->forward_id,'mail.partials.forwarded-message',['thread'=>$message->forwardedThread])

    @endforeach
</div>