@if(auth()->user()->unreadMessagesCount())
    <span class="badge badge-info right" wire:poll.5s>
    {{auth()->user()->unreadMessagesCount()}}
    </span>
@endif
