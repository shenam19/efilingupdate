<x-app-layout>
    <x-header>
    </x-header>

    <div class="container-fluid">
        <div class="row">
            <!-- BEGIN SEARCH RESULT -->
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <th>#</th>
                        <th>གཏོང་མཁན།</th>
                        <th>ཡི་གེའི་ཨང་།</th>
                        <th>གནད་དོན།</th>
			<th>གཏོང་ཡུལ།</th>
			<th>རྣམ་པ།</th>
                        <th>{{$type ==='incoming' ? 'འབྱོར་ཚེས།': 'བཏང་ཚེས།'}}</th>
                    </thead>
                    <tbody>	
                        @forelse($messages as $message)     
                        <tr>
                            <td>
                                @if($type === 'incoming')    
                                    {{$message->getIncomingNo($myOrgs)}}
                                @else
                                    {{$message->record->outgoing_no}}
                                @endif
                            </td>
                            <td>
                                {{ $message->is_user ? $message->organization->name_short : $message->contactSender->name}}
                            </td>
                            <td>
                                {{$message->record->outgoing_word}}
                            </td>
                        
                            <td>
                                {{$message->subject}}
                            </td>
                           
                            <td>
                                @if($type === 'incoming')
                                    @foreach($message->recipients as $recipient)
                                        @if(in_array($recipient->organization_id,$myOrgs))
                                            {{$recipient->organization->name_short}}
                                        @endif
                                    @endforeach
                                @else
                                    @foreach($message->recipients as $recipient)
                                        @if($recipient->is_user)
                                            @if(!in_array( $recipient->organization_id, $myOrgs,))
                                                {{$recipient->user->organization->name_short}}{{$loop->last ? '': ','}} 
                                            @endif
                                        @else
                                            {{$recipient->contact->name}}{{$loop->last ? '': ','}} 
                                        @endif
                                    @endforeach
                                @endif
                            </td>
                            <td>
                                {{$message->record->mode}}
                            </td>    
                            <td>
                                {{ $type==='incoming' 
                                    ? date('d/m/Y',strtotime($message->record->received_date)) 
                                    : date('d/m/Y',strtotime($message->record->dispatched_date)) 
                                }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-primary">
                            ཡིག་ཁུག་སྟོང་པ་རེད་འདུག
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!-- END SEARCH RESULT -->
        </div>
    </div>
    @push('scripts')
    <script>
        window.onload = function() { 
            window.print(); 
        }
    </script>
    @endpush
</x-app-layout>

