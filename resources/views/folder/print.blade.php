<x-app-layout>
    <x-header>
    </x-header>
    <div class="container-fluid">
        <div class="row">
            <!-- BEGIN SEARCH RESULT -->
            <div class="col-md-12">
                <table class="table table-bordered">
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
                        @if(in_array($message->organization_id,$orgs))
                        @php
                        $url = $message->record
                        ? route('record.show',['type' => 'outgoing', 'message' => $message])
                        : route('show', $message->uuid);
                        @endphp
                        @else
                        @php
                        $url = $message->record
                        ? route('record.show',['type' => 'incoming', 'message' => $message])
                        : route('show', $message->uuid);
                        @endphp
                        @endif
                        <tr class="{{ $message->isUnread() ? 'unread font-weight-bold': '' }} {{ isset($message->prevPullBack) ? 'pullback_msg' : ''}}"
                            data-url="{{$url}}">
                            <td>
                                <input type="checkbox" wire:model="selected" value="{{$message->id}}">
                            </td>
                            <td class="redirect">
                                <small>
                                    @if(in_array($message->organization_id,$orgs))
                                    <a href="{{$url}}" class="text-success">
                                        <i class="fas fa-arrow-up"></i>
                                        {{$message->record?->outgoing_no}}
                                    </a>
                                    @else
                                    <a href="{{$url}}" class="text-primary">
                                        <i class="fas fa-arrow-down"></i>
                                        {{ $message->getIncomingNo($myOrgs) }}
                                    </a>
                                    @endif
                                </small>
                            </td>
                            <td class="redirect small">
                                @if(in_array($message->organization_id,$orgs))
                                {{ $message->record ? dateString($message->record->dispatched_date) : dateString($message->created_at) }}
                                @else
                                {{ $message->record ? dateString($message->record->received_date) : dateString($message->created_at)}}
                                @endif
                            </td>
                            <td class="redirect">
                                {{$message->getSenderOrgName()}}
                            </td>
                            <td class="redirect">
                                {{$message->getRecipientsNames()}}
                            </td>
                            <td class="redirect">
                                {{$message->subject}}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-primary">
                                ཡི་གེ་མི་འདུག
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