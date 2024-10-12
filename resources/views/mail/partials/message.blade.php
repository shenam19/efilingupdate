
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/message.css') }}">
@endpush

<div class="messaging">
    <div class="inbox_msg">

        <!------- MAIN MESSAGE ----->
        <div class="mesgs">
            <div class="msg_history">
                <div class="incoming_msg">
                    <div class="received_msg">
                        <div class="msg_header">
                            <p>{{$message->getOriginalMessage($showLatest)->subject}}  <span class="time_date float-right"> {{$message->getOriginalMessage($showLatest)->created_at->toDayDateTimeString()}}</span></p>
                            <p class="time_date">གཏོང་མཁན། {{$message->getOriginalMessage($showLatest)->getSenderName()}}<span class="time_date float-right"> {{$message->getOriginalMessage($showLatest)->record?->outgoing_word}}</span></p>
                        </div>
                        <div class="msg_body">
                            <p>{{$message->getOriginalMessage($showLatest)->remarks}}</p>
                            <div class="row py-3">
                            @forelse($message->getOriginalMessage($showLatest)->attachments as $media) 
                                <div class="col-3 mb-2">
                                    <div class="card h-100">
                                        <a class="border" href="{{ route('media.show',$media->uuid)}}" target="_blank"
                                        style="
                                            background-image:url({{ getThumb(getExtension($media->file_name),$media->uuid)}});  
                                            background-repeat: no-repeat;
                                            background-position: center;
                                            background-size: contain;
                                            height:200px;">
                                        </a>
                                        <div class="px-2 pt-2">
                                            <small>{{$media->file_name}}</small>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <div class="col-12 text-center align-item-center">
                                    <h1><i class="fas fa-exclamation text-danger"></i></h1>
                                    ཡིག་པར་མི་འདུག 
                                </div>
                                @endforelse
                            </div>                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!---- END OF MAIN MESSAGE ----->

        @if($message->forward_id)
            <div class="inbox_people">
                <div class="headind_srch">
                    <div class="recent_heading">
                        <h4 class="text-center text-primary">ཟུར་མཆན། / Noting</h4>
                    </div>
                </div>
                <!---- FORWARDED NOTING MESSAGES ------>
                <div class="inbox_chat accordion">
                    @while($message->forward_id)
                        <div class="chat_list">
                            <div class="chat_people">
                                <div class="chat_ib">
                                    <p class="muted">མཆན་འགོད་མཁན། {{$message->getSenderName()}}
                                        <span class="chat_date">{{ $message->created_at->toDayDateTimeString()}}</span>
                                    </p>
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
                                    <p class="muted">མཆན་འགོད་ཡུལ། 
                                        @foreach($message->recipients as $recipient)
                                            {{$recipient->user->name}}{{ $loop->last ? '' : ','}}
                                        @endforeach                                        
                                    </p>

                                </div>
                            </div>
                        </div>
                        @php 
                            $message = $message->forwarded
                        @endphp
                    @endwhile
                </div>
                <!---- END FORWARDED NOTING MESSAGES ------>
            </div>
        @endif
    </div>
</div>