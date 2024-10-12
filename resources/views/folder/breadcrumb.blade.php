<div class="row">
    <div class="col">
        <nav aria-label="breadcrumb">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-caret flex-row-reverse">
                <li class="breadcrumb-item">
                    <a href="#" class=""><span class="fas fa-folder mr-1"></span></a>
                </li>
                @foreach($folder->getRootFolder()->subfolders as $f)
                    <li class="breadcrumb-item">
                        <a href="#" class="">{{$f->file_no}}</a>
                    </li>
                @endforeach
                <li aria-current="page" class="breadcrumb-item active">{{$folder->file_no}}</li>
              </ol>
            </nav>
        </nav>
    </div>
</div>