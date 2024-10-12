<div class="row">
    <ul class="mailbox-attachments d-flex flex-wrap justify-content-start pl-2 py-3 w-100">
        @forelse($medias as $media)
            <div style="width:20%">
                <li class="">
                    @include('media.partials.single',['media' => $media,'action'=>$action])
                </li>
            </div>
        @empty
            <div class="col-12 d-flex text-center text-dark flex-column py-4">
                <h1><i class="fas fa-exclamation"></i><h1>
                <h5>ཡིག་པར་མི་འདུག</h5>
            </div>
        @endforelse
    </ul>
    <div class="col-12 pl-3">
        {{ $medias->links() }}
    </div>
</div>