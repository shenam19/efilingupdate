
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/message.css') }}">
@endpush

<div class="messaging">
    <div class="inbox_msg">
        <div class="mesgs">
            <div class="msg_history">
                <div class="incoming_msg">
                    <div class="received_msg">
                        <div class="msg_header">
                            <p>{{$message->getOriginalMessage($showLatest)->subject}}  <span class="time_date float-right"> {{$message->getOriginalMessage($showLatest)->created_at->toDayDateTimeString()}}</span></p>
                            <p class="time_date">From {{$message->getOriginalMessage($showLatest)->getSenderName()}}</p>
                        </div>
                        <div class="msg_body">
                            <p>{{$message->getOriginalMessage($showLatest)->remarks}}</p>
                            @foreach($message->getOriginalMessage($showLatest)->attachments as $media)
                                <div class="msg_attachment">
                                    <a href="{{ route('media.show',$media->uuid)}}" target="_blank">
                                        <embed src="{{ route('media.show',$media->uuid)}}" width="100%" height="650px" type="{{$media->mime_type}}"/>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if($message->forward_id)
            <div class="inbox_people">
                <div class="headind_srch">
                    <div class="recent_heading">
                        <h4 class="text-center text-primary">ཟུར་མཆན། / Noting</h4>
                    </div>
                </div>
                <div class="inbox_chat accordion">
                    @while($message->forward_id)
                        <div class="chat_list">
                            <div class="chat_people">
                                <div class="chat_ib">
                                    <p class="muted">{{ $message->created_at->toDayDateTimeString()}}</p>
                                    <h5>{{$message->remarks}}</h5>
                                    <div class="d-flex" style="font-size:18px">
                                        @foreach($message->attachments as $attachment)
                                            <a href="{{ route('media.show',$attachment->uuid)}}" target="_blank"> 
                                                @php 
                                                    $ext = getExtension($attachment->file_name)
                                                @endphp

                                                @if($ext === 'PDF')
                                                    <i class="fas fa-file-pdf mr-3"></i>
                                                @elseif($ext === 'DOC' || $ext ==='DOCX')
                                                    <i class="fas fa-file-word mr-3"></i>
                                                @else
                                                    <i class="fas fa-file-image mr-3"></i>
                                                @endif
                                            </a>
                                        @endforeach
                                    </div>
                                    <p class="muted">Refer To: {{$message->getRecipientsNames()}}<span class="chat_date">From: {{$message->getSenderName()}}</span></p>

                                </div>
                            </div>
                        </div>
                        @php 
                            $message = $message->forwarded
                        @endphp
                    @endwhile
                </div>
            </div>
        @endif
    </div>
</div>