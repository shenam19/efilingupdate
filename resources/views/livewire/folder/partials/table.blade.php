<table class="table table-inbox">
    <thead class="thead-light">
        <th></th>
        <th>#</th>
        <th>ཚེས།</th>
        <th>གཏོང་མཁན།</th>
        <th>གཏོང་ཡུལ།</th>
        <th>གནད་དོན།</th>
    </thead>
    <tbody>
        @forelse($messages as $message)
            <tr class="{{ $message->isUnread() ? 'unread font-weight-bold' : '' }} {{ isset($message->prevPullBack) ? 'pullback_msg' : '' }}"
                data-url="">
                <td class="">
                    <input type="checkbox" wire:model.live="selected" value="{{ $message->id }}">
                </td>

                <td class="inbox-small-cells">
                    <small>
                        @if (in_array($message->organization_id, $orgs))
                            <a href="{{ $message->record
                                ? route('record.show', ['type' => 'outgoing', 'message' => $message])
                                : route('show', $message->uuid) }}"
                                class="text-success">
                                <i class="fas fa-arrow-up"></i>
                                {{ $message->getOutgoingLetterNo() }}
                            </a>
                        @else
                            <a href="{{ $message->record
                                ? route('record.show', ['type' => 'incoming', 'message' => $message])
                                : route('show', $message->uuid) }}"
                                class="text-primary">
                                <i class="fas fa-arrow-down"></i>
                                {{ $message->getIncomingNo($myOrgs) }}
                            </a>
                        @endif
                    </small>
                </td>
                <td class="inbox-small-cells small">
                    @if (in_array($message->organization_id, $orgs))
                        {{ $message->record ? dateString($message->record->dispatched_date) : dateString($message->created_at) }}
                    @else
                        {{ $message->record ? dateString($message->record->received_date) : dateString($message->created_at) }}
                    @endif
                </td>
                <td class="inbox-small-cells">

                    {{ $message->getSenderOrgName() }}

                </td>

                <td class="inbox-small-cells">
                    {{ $message->getRecipientsNames() }}
                </td>

                <td class=" ">
                    {{ $message->subject }}
                </td>
            </tr>
        @empty
            <tr>
                <td class="text-center text-primary">
                    No messages!
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
@push('scripts')
    <script>
        //Clicking the td except for the first one will open that message
        $(".table-inbox tr td:not(:last-child)").click(function() {
            window.location.href = $(this).parent().attr("data-url");;
        });
    </script>
@endpush
