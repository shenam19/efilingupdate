<span class="badge {{ $count ? 'badge-warning' : ''}} navbar-badge" wire:poll.5s>
    @if($count)
        {{$count}}
    @endif
</span>
