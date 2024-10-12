<x-app-layout>
    <x-header>
        {{$type=== 'outgoing' ? 'ཕྱིར་བཏང་' : 'ནང་འབྱོར་' }}{{ __('ཟིན་ཐོ།')}}
    </x-header>

    <style>
        .message-header{
            display:flex;
            justify-content: space-between; 
            align-items:center;
            padding:22px 8px;
            background-color:#457b9d;
            border: 1px solid #ddd;
            color:white;
        }

        .message-data{
            display:flex;
            flex-direction: column;
            background-color:white;
        }
        .message-data .data-row{
            padding:8px 8px;
            width:100%;
            border-bottom:1px solid #ddd;
        }
        
    </style>
    <div class="container-fluid">
        <div class="row pr-2" >
            <!---- Message MetaData --->
            <div class="col-md-4">
                <div class="message-header">
                    <div class="lead">
                       <i class="far fa-file-alt"></i> {{$message->record->outgoing_word}}
                    </div>
                    <div class="small"> 
                        @if($type  === 'incoming')
                            {{$message->getIncomingNo($myOrgs)}} <i class="fas fa-arrow-down align-middle"></i>
                        @else
                            {{$message->record->outgoing_no}} <i class="fas fa-arrow-up align-middle"></i>
                        @endif
                    </div>
                </div>
                <div class="message-data">
                    <div class="data-row">
                        <small class="text-muted"><i class="fa fa-align-left"></i>ནང་དོན།</small>
                        <div class="data">{{$message->subject}}</div>
                    </div>

                    <div class="data-row">
                        <small class="text-muted"><i class="far fa-envelope"></i> བསྐུར་ཡུལ།</small>
                        <div class="data">
                            @foreach($message->recipients as $recipient)
                                @if($recipient->is_user)
                                    {{$recipient->user->organization->name_short}}{{$loop->last ? '': ','}} 
                                @else
                                    {{$recipient->contact->name}}{{$loop->last ? '': ','}} 
                                @endif
                            @endforeach
                        </div>
                    </div>

                    <div class="data-row">
                        <small class="text-muted"><i class="far fa-paper-plane"></i> གཏོང་མཁན།</small>
                        <div class="data">
                            {{$message->getSenderName()}}
                            @if($message->is_user AND $message->sender->organization->belongs_to_id)
                                <span class="text-muted">({{$message->sender->organization->getRoot()->name_short}})</span>
                            @endif
                        </div>
                    </div>

                    <div class="data-row">
                        <small class="text-muted"><i class="far fa-calendar-alt"></i> བཏང་ཚེས།</small>
                        <div class="data">{{Carbon\Carbon::parse($message->record->dispatched_date)->format('d/m/Y h:i A')}} </div>
                    </div>
                    
                    @if($type==='incoming')
                    <div class="data-row">
                        <small class="text-muted"><i class="far fa-calendar-alt"></i> འབྱོར་ཚེས།</small>
                        <div class="data ">{{Carbon\Carbon::parse($message->record->received_date)->format('d/m/Y h:i A')}}</div>
                    </div>
                    @endif

                    <div class="data-row">
                        <small class="text-muted"><i class="fas fa-bullhorn"></i> འཕྲིན་ཐུང་དབྱེ་བ།</small>
                        <div class="data">{{$message->type->name_tibetan}}</div>
                    </div>

                    <div class="data-row">
                        <small class="text-muted"><i class="fa fa-mail-bulk"></i> རྣམ་པ།</small>
                        <div class="data">{{$message->record->mode}}</div>
                    </div>

                     <div class="data-row">
                        <small class="text-muted"><i class="fa fa-globe"></i> སྐད་ཡིག།</small>
                        <div class="data">{{$message->record->language}}</div>
                    </div>
                </div>
            </div>
            <!----- MESSAGE ATTACHMENTS ----->
            @if($message->hasAccess())
            <div class="col-md-8 bg-white mb-2">
                <div class="message-remarks border-bottom py-2">
                    <div class="data-row">
                        <div class="d-flex justify-content-between">
                            <div>
                                <small class="text-muted"><i class="far fa-comment-alt"></i>ཟུར་མཆན།</small>
                            </div>
                            @livewire('forward-message',compact('message'))
                        </div>
                        
                        <div class="data">{{$message->remarks}}</div>
                    </div>
                </div>
                <div class="row py-3">
                    @forelse($message->attachments as $media)
                        <div class="col-3 mb-2">
                            <div class="card h-100">
                                <a class="border" href="{{ route('media.show',$media->uuid)}}" target="_blank"
                                    style="
                                    background-image:url({{ getThumb(getExtension($media->file_name),$media->uuid)}});  
                                    background-repeat: no-repeat;
                                    background-position: center;
                                    background-size: cover;
                                    height:200px;">
                                </a>
                                <div class="px-2 pt-2">
                                    <small>{{$media->file_name}}</small>
                                </div>
                            </div>
                        </div>
                    @empty
                    <div class="col-12 h-100 d-flex align-item-center justify-content-center   ">
                        <div class="text-center  ">
                            <h1><i class="fas fa-exclamation text-danger"></i></h1>
                            ཡིག་པར་མི་འདུག
                        </div>
                    </div>
                        
                    @endforelse
                    </div>
                </div>
            </div>
            @else
            <div class="col-md-8 bg-dark d-flex justify-content-center align-items-center">
                <div class="text-center">
                    <h1><i class="fas fa-exclamation text-danger"></i></h1>
                    YOU DON'T HAVE ACCESS TO THIS RECORD!
                    <small class="d-block">Please ask the receiver of this record to share access.</small>
                </div>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>