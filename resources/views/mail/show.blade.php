<x-app-layout>
    <x-header>
        {{ __('གློག་འཕྲིན་ཀློགས།') }}
    </x-header>
    <!-- Main content -->
    <section class="content">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-primary card-outline">
                    <div class="card-header 
					@if(isset($message->pullBack)) 
                        bg-gradient-danger				
                    @elseif(isset($message->prevPullBack) && !isset($message->pullBack))
                        bg-gradient-green
                    @endif">
                        <h2 class="card-title font-weight-bold h3" style="color: black">{{$message->forward_id ? 'Fwd:'.$message->getOriginalMessage()->subject :$message->subject}}</h2>
                        <div class="float-right">
                            @if($message->canUnsent() || isset($message->prevPullBack) || isset($message->pullBack))
                            <div class="file-menu mr-2 ml-auto">
                                <a href="#" data-toggle="dropdown" class="file-options">
                                    <i class="fas fa-ellipsis-v" style="color: black"></i></a>
                                <div class="dropdown-menu">
                                    @if($message->canUnsent())
                                    <button class="dropdown-item btn btn-sm" data-toggle="modal"
                                        data-target="#folderCreate"
                                        onclick="location.href='{{ route('pullback.show',$message->uuid) }}';">
                                        <i class="fas fa-undo align-middle"></i> ཕྱིར་འཐེན་བྱོས།
                                    </button>
                                    @endif
                                    @if(isset($message->prevPullBack))
                                    <div class="dropdown-divider"></div>
                                    <button type="button" class="dropdown-item btn  btn-sm"
                                        onclick="location.href='{{ route('show', $message->prevPullBack->oldMessage->uuid)}}';">
                                        <i class="fas fa-arrow-left"></i> Old Version
                                    </button>
                                    @endif
                                    @if(isset($message->pullBack))
                                    <div class="dropdown-divider"></div>
                                    <button type="button" class="dropdown-item btn  btn-sm"
                                        onclick="location.href='{{ route('show', $message->pullBack->newMessage->uuid)}}';">
                                        <i class="fas fa-arrow-right"></i> New Correction
                                    </button>
                                    @endif
                                </div>
                            </div>
                            @endif
                            
                        </div>
                    </div>
                    <div class="card-body p-0">
                        @if(isset($message->pullBack))
                        <div class="p-3 border-left border-right">
                            <span class="text-bold">This message was pulled back. The reason given was: </span>
                            <p class="text-blue">{{$message->pullBack->reason}}</p>
                        </div>
                        @endif
                        @includeWhen($message->hasAccess(),'mail.partials.message',['message'=>$message,'showLatest' => !isset($message->pullBack) ])

                    </div>
                    <div class="card-footer">
                        @if($message->status === 'sent')
                        @livewire('forward-message',['message'=>$message])
                        @endif                        
                        <button type="button" class="btn btn-default" onclick="location.href='{{ route('print',$message->uuid) }}';">
                             <div data-toggle="tooltip" data-placement="top" title="Print"><i class="fas fa-print"></i>པར་སྐྲུན་བྱོས།</div>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        @if($message->user_id === auth()->id() && $message->forwarded === null)
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h2 class="card-title font-weight-bold h3" style="color: black">Tracking Information</h2>
                    </div>
                    <div class="card-body p-0" style="overflow-x: scroll">
                        <!-- todo: forward chain -->                        
                        <div class="card-body">
                            <div class="callout callout-success" style="width: max-content;">
                                <h5>Message Sent</h5>
                                <p>You sent this message to <span class="text-primary">{{$message->getRecipientsNames()}}</span>  on {{$message->created_at->toDayDateTimeString()}}</p>
                            </div>
                            @php
                                $stack = array();                                                                
                                foreach($message->forwarder as $k=>$v){
                                    array_push($stack, [$v,1]);                                    
                                }                                  
                            @endphp
                            @while(!empty($stack))
                                @php
                                    [$message,$depth] = array_pop($stack);                                                                        
                                @endphp
                                <div class="callout callout-info" style="margin-left: {{$depth}}rem; width: max-content;">
                                    <h5>{{ $depth }}. Forwarded</h5>
                                    <p><span class="text-primary"> {{$message->getSenderName()}}</span> forwarded to <span class="text-primary"> {{$message->getRecipientsNames()}}</span> on {{$message->created_at->toDayDateTimeString()}}</p>
                                </div>                                
                                @php                                                                     
                                foreach($message->forwarder as $k=>$v){
                                    array_push($stack, [$v, $depth + 1]);                                    
                                }
                                @endphp
                            @endwhile                            
                        </div>

                    </div>
                </div>
            </div>
        </div>
        @endif
    </section>
</x-app-layout> 