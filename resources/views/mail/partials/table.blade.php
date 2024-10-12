@push('styles')
<link rel="stylesheet" href="{{asset('css/message-table.css')}}">
@endpush
<table class="table table-inbox">
    <tbody>	
        @forelse($messages as $message)     
        <tr class="{{ $message->isUnread() ? 'unread font-weight-bold': '' }} {{ isset($message->prevPullBack) ? 'pullback_msg' : ''}}" 
        data-url="{{ $type === 'draft'  ? route('draft.show', $message->uuid) : route('show', $message->uuid)}}">
            <td class="inbox-small-cells checkbox-cell">
                <input type="checkbox" class="mail-checkbox" wire:model="selected" value="{{$message->forward_id ? $message->getOriginalMessage()->id : $message->id}}">
            </td>
            <td class="redirect" style="line-height: 1">
                @if($type === 'sent' || $type === 'draft')
                    གཏོང་ཡུལ།: {{$message->getRecipientsNames()}}
                @else 
                    གཏོང་མཁན།: {{$message->getSenderName()}}
                    @if($message->is_user)
                    <small class="d-block text-secondary">{{$message->sender->email}}</small>
                    @endif
                @endif
            </td>
            <td class="inbox-small-cells redirect">
                <x-urgency :value="$message->getOriginalMessage()->urgency"/>
            </td>
           
            <td class="redirect">
                @if($message->forward_id)
                    @if($message->getOriginalMessage()->record && $type ==='inbox')
                        <span class="badge badge-primary right">
                        {{ $message->getOriginalMessage()->getIncomingNo()}}
                        </span>
                    @endif

                    Fwd:{{$message->getOriginalMessage()->subject}}
                @else
                    @if($message->record AND $type ==='inbox')
                        <span class="badge badge-primary right">
                        {{ $message->getIncomingNo()}}
                        </span>
                    @endif

                    {{$message->subject}}
                @endif
            </td>
            <td class="inbox-small-cells text-secondary text-right redirect">({{$message->type->name_tibetan}})</td>
            <td class="inbox-small-cells text-center">
                @if($message->attachments_count)
                <i class="fa fa-paperclip"></i>
                @endif

                @if($type==='sent')
                    @livewire('read-status', ['recipients' => $message->recipients,'message_id' => $message->id], key($message->id))
                @endif

                @livewire('folder-status',['folderArr'=>$orgsFolder,'message'=>$message->getOriginalMessage()], key('folder-'.$message->id))

            </td>
             
            <td class="inbox-small-cells  text-right redirect small">
                @if($message->record)
                    {{ $type==='inbox' 
                        ? Carbon\Carbon::parse($message->record->received_date)->format('d/m/Y h:i A')
                        :  Carbon\Carbon::parse($message->record->dispatched_date)->format('d/m/Y h:i A')
                    }}
                @else
                    {{ Carbon\Carbon::parse($message->updated_at)->format('d/m/Y h:i A') }}
                @endif
            </td>
        </tr>
        @empty
        <tr>
            <td class="text-center text-primary">
                ཡིག་ཁུག་སྟོང་པ་རེད་འདུག 
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

@push('scripts')
<script>
    //Clicking the td except for the first one will open that message
    $(".table-inbox tr .redirect").click(function(){
        window.location.href = $(this).parent().attr("data-url");;
    });
</script>
@endpush