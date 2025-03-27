<div class="container-fluid py-2">
    <div class="nav nav-tabs nav-fill w-50" id="nav-tab" role="tablist">
        <a wire:click="$set('type','mine')"class="nav-item nav-link {{ $type === 'mine' ? 'active' : '' }}"
            id="nav-home-tab" data-toggle="tab" href="#my-media" role="tab" aria-controls="nav-home"
            aria-selected="true">ངའི་ཡིག་པར།</a>
        <a wire:click="$set('type','shared')"class="nav-item nav-link {{ $type === 'shared' ? 'active' : '' }}"
            id="nav-profile-tab" data-toggle="tab" href="#shared-media" role="tab" aria-controls="nav-profile"
            aria-selected="false">ང་ལ་བརྒྱུད་སྤེལ་བྱས་པ།</a>
    </div>

    <div class="bg-light border mx-auto">
        <div class="row">
            <div class="col-2 px-3 pt-2">
                <div class="form-group">
                    <label class="small">གོ་རིམ་སྒྲིགས།</label>
                    <select class="form-control" wire:model.live="sort">
                        <option value="DESC">གསར་ཤོས།</option>
                        <option value="ASC">རྙིང་ཤོས།</option>
                    </select>
                </div>
            </div>

            <div class="col-2 px-3 pt-2">
                <div class="form-group">
                    <label class="small">ཕྱི་ལོ།</label>
                    <select class="form-control" wire:model.live="year">
                        <option value="">ཕྱི་ལོ་འདེམས།</option>
                        @for ($i = 2022; $i <= date('Y'); $i++)
                            <option>{{ $i }}</option>
                        @endfor
                    </select>
                </div>
            </div>

            <div class="col-2 px-3 pt-2">
                <div class="form-group">
                    <label class="small">ཕྱི་ཟླ།</label>
                    <select class="form-control" wire:model.live="month">
                        <option value="">ཕྱི་ཟླ་འདེམས།</option>
                        <option value="1">ཕྱི་ཟླ་༡</option>
                        <option value="2">ཕྱི་ཟླ་༢</option>
                        <option value="3">ཕྱི་ཟླ་༣</option>
                        <option value="4">ཕྱི་ཟླ་༤</option>
                        <option value="5">ཕྱི་ཟླ་༥</option>
                        <option value="6">ཕྱི་ཟླ་༦</option>
                        <option value="7">ཕྱི་ཟླ་༧</option>
                        <option value="8">ཕྱི་ཟླ་༨</option>
                        <option value="9">ཕྱི་ཟླ་༩</option>
                        <option value="10">ཕྱི་ཟླ་༡༠</option>
                        <option value="11">ཕྱི་ཟླ་༡༡</option>
                        <option value="12">ཕྱི་ཟླ་༡༢</option>
                    </select>
                </div>
            </div>

            @if ($type === 'shared')
                <div class="col-3 px-3 pt-2">
                    <div class="form-group">
                        <label class="small">རྒྱུད་སྤེལ་བྱེད་མཁན།</label>
                        <select class="form-control" wire:model.live="sharedBy">
                            <option value="">འདེམས།</option>
                            @foreach ($orgs as $org)
                                <option>{{ $org }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @endif
        </div>
        <div class="dropdown-divider"></div>
        @include('media.partials.gallery', ['medias' => $media, 'action' => $action])
    </div>

    <!------- Edit Media Modal  ------->
    <div wire:ignore class="modal fade" id="edit_media" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Media Name</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Media Name</label>
                        <input type="text" class="form-control" wire:model.live="name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" wire:click="edit()">Save
                        changes</button>
                </div>
            </div>
        </div>
    </div>

</div>
