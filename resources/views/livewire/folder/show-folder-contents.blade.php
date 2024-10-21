<div class="col-9 border p-0 h-100" style="overflow-y: scroll;">
    <div class="row">
        <div class="col p-0 ">
            @if($file)
            <div class="card-header bg-light d-flex justify-content-between">
                <div class="card-title flex-grow-1">{{ $file['file_no'].' '.$file['name'] }}

                    <button class="btn btn-default ml-2" data-toggle="modal" data-target="#dateSelect">
                        <i class="fa fa-print"></i>
                    </button>

                    <!----- date range picker modal --->
                    <x-date-range-picker-modal :route="route('folder.print',$file['id'])"
                        :title="'Select which date to print records'" />

                </div>
                <div class="card-menu d-flex">

                    <button class="btn btn-link text-secondary p-0 mr-2" data-toggle="modal" data-target="#editFile"><i
                            class="fas fa-pen"></i></button>
                    <button class="btn text-secondary p-0 mx-2" data-toggle="modal" data-target="#showRecordLists"><i
                            class="fas fa-plus-circle"></i></button>
                    @include('folder.records-list',['messages'=>$message_lists])
                    <button class="btn text-danger p-0 ml-2" {{ $this->selectedCount ? '' : 'disabled' }}
                        onclick="removeConfirm()"><i class="fas fa-minus-circle"></i></button>
                </div>
            </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col">
            @if($file)
            <div class="form-row pt-2 d-flex justify-content-start px-2">
                <div class="col-2">
                    <div class="form-group">
                        <select class="form-control" wire:model="type">
                            <option value="">ཚང་མ།</option>
                            <option value="incoming">ནང་འབྱོར།</option>
                            <option value="outgoing">ཕྱིར་བཏང་།</option>
                        </select>
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <select class="form-control" wire:model="fiscalYear">
                            @for($year = 2022; $year <= date('Y'); $year++) <option>{{$year .' - '. $year+1}}</option>
                                @endfor
                        </select>
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <input type="date" class="form-control input-sm " wire:model="date">
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-search">
                        <i class="fa fa-search"></i>
                        <input type="text" class="form-control form-input" placeholder="འཚོལ།" wire:model="search">
                    </div>
                </div>
                <div class="col text-xs">
                    {{$messages->links('vendor.pagination.custom')}}
                </div>
            </div>

            <div class="table-responsive">
                @include('folder.partials.table',compact('orgs','messages'))
            </div>
            @endif
        </div>
    </div>

    <!------- File Edit Modal -------------->
    <div class="modal fade" id="editFile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ཡིག་ཁུག་བཟོས།</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('folders.update',$file ?? '0')}}">
                    @method('PUT')
                    @csrf
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="col-4" wire:ignore>
                                <label>སྡེ་ཚན།<span class="text-danger">*</span></label>
                                <x-section-tree-dropdown id="orgTreeSelectEdit" :orgs="$sections" name="works_at" />

                            </div>
                            <div class="col-4">
                                <label>བཟོས་ཚེས།</label>
                                <input type="date" class="form-control" placeholder="འདིར་འབྲི་རོགས།" name="date_opened"
                                    value="{{$file?->date_opened}}">
                            </div>

                            <div class="col-4">
                                <label>ཡིག་ཁུག་ཨང་། <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('file_no') is-invalid @enderror"
                                    placeholder="འདིར་འབྲི་རོགས།" name="file_no" value="{{$file?->file_no }}" required>
                                @error('subject')
                                <div class="text-danger font-italic" style="font-size:0.8rem">*{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row mt-2">
                            <div class="col-8">
                                <label>ཡིག་ཁུག་མིང་། <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('file_name') is-invalid @enderror"
                                    placeholder="འདིར་འབྲི་རོགས།" name="file_name" value="{{ $file?->name}}" required>
                                @error('subject')
                                <div class="text-danger font-italic" style="font-size:0.8rem">*{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-4">
                                <label>གནད་དོན་དབྱེ་བ།</label><br>
                                <div class="form-group  clearfix custom-radio">
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" name="type" value="general"
                                            {{ $file?->file_type ==='general' ? 'checked' : ''}}>
                                        <label for="radioPrimary1">སྤྱི།</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-4">
                                        <input type="radio" name="type" value="subject-file"
                                            {{ $file?->file_type ==='subject-file' ? 'checked' : ''}}>
                                        <label for="radioPrimary2">བྱེ་བྲག</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ཁ་རྒྱོབས།</button>
                        <input type="submit" class="btn btn-primary" value="འགོད་འབུལ་ཞུས།">
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
    Livewire.on('EditFile', (select) => {
        orgTreeSelectEdit.value = select;
    });
    </script>

    @endpush
</div>