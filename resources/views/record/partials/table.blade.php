@push('styles')
    <link rel="stylesheet" href="{{ asset('css/message-table.css') }}">
@endpush
<table class="table table-inbox">
    <thead class="thead-light">
        <th></th>
        <th class="text-center">#</th>
        <th>{{ $type === 'incoming' ? 'གཏོང་མཁན།' : 'གཏོང་ཡུལ།' }}</th>
        <th></th>
        <th>གནད་དོན།</th>
        <th></th>
        <th>{{ $type === 'incoming' ? 'འབྱོར་ཚེས།' : 'བཏང་ཚེས།' }}</th>
        <th></th>
    </thead>
    <tbody>
        @forelse($messages as $message)
            <tr wire:key="message-{{ $message->id }}"
                class="{{ $message->isUnread() ? 'unread font-weight-bold' : '' }}{{ isset($message->prevPullBack) ? 'pullback_msg' : '' }}"
                onclick="location.href='{{ route('record.show', ['type' => $type, 'message' => $message]) }}'">
                <td class="inbox-small-cells checkbox-cell">
                    <input type="checkbox" class="mail-checkbox" wire:model.live="selected" value="{{ $message->id }}"
                        onclick="event.stopPropagation();">
                </td>

                <td class="redirect
                        text-center">
                    @if ($type === 'incoming')
                        {{ $message->getIncomingNo($myOrgs) }}
                    @else
                        {{ $message->record->outgoing_no }}
                    @endif
                </td>
                <td class="redirect" style="line-height: 1">
                    @if ($type === 'incoming')
                        {{ $message->getSenderName() }}
                        @if ($message->is_user)
                            <small
                                class="d-block text-secondary">{{ $message->sender->organization->getRoot()->name_short }}</small>
                        @endif
                    @else
                        {{ $message->getRecipientsNames() }}
                    @endif
                </td>
                <td class="redirect">
                    <x-urgency :value="$message->urgency" />
                </td>

                <td class="redirect ">
                    {{ $message->subject }}
                </td>
                <td class="">
                    @if ($message->attachments_count)
                        <i class="fa fa-paperclip"></i>
                    @endif

                    @livewire('folder-status', ['folderArr' => $orgsFolder, 'message' => $message], key('folder-' . $message->id))
                </td>

                <td class="redirect small">
                    {{ $type === 'incoming'
                        ? Carbon\Carbon::parse($message->record->received_date)->format('d/m/Y h:i A')
                        : Carbon\Carbon::parse($message->record->dispatched_date)->format('d/m/Y h:i A') }}
                </td>

                <td class="inbox-small-cells action-btn">
                    @if ($message->isEditable($myOrgs))
                        <a class="text-secondary small"
                            href="{{ route('record.edit', ['type' => $type, 'message' => $message]) }}">
                            <i class="fas fa-pen"></i>
                        </a>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center text-primary">
                    ཡིག་ཁུག་སྟོང་པ་རེད་འདུག
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
