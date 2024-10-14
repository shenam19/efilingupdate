<div class="row">
    <!-- BEGIN FILTERS -->

    <div class="col-md-3 d-print-none">
        <h5 class="grid-title"><i class="fa fa-filter"></i> དབྱེ་གསེས།</h5>
        <hr>

        <div class="form-group" wire:ignore>
            <label for="message_type_dd">{{$type=== 'outgoing' ? 'བསྐུར་ཡུལ།' : 'གཏོང་མཁན།' }}</label>
            <x-dropdown :option="$contacts" name="recipients[]" id="contactSelect" :multiple="true" placeholder="འདེམས།"
                v-on:input="setData" />
        </div>

        <div class="form-group">
            <label for="message_type_dd">འཕྲིན་ཐུང་དབྱེ་བ།</label>
            <select class="form-control" wire:model="msg_type">
                <option value="">འདེམས།</option>

                @foreach($msg_types as $mtype)
                <option value="{{$mtype->id}}">{{$mtype->name_tibetan}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="message_type_dd">གལ་འགངས།</label>
            <select class="form-control" wire:model="urgency">
                <option value="">འདེམས།</option>
                <option value="gray">ཆུང་བ།</option>
                <option value="yellow">འབྲིང་བ།</option>
                <option value="orange">ཆེ་བ།</option>
                <option value="red">ཛ་དྲག</option>
            </select>
        </div>

        <div class="form-group">
            <label for="message_type_dd">{{$type=== 'outgoing' ? 'བཏང་ཚེས།' : 'འབྱོར་ཚེས།' }}</label>
            <div class="row">
                <div class="col-xl-6 col-lg-12">
                    <span>ནས།</span><input type="date" class="form-control  input-sm h-65" wire:model="date1">
                </div>
                <div class="col-xl-6 col-lg-12">
                    <span>བར།</span><input type="date" class="form-control h-65" wire:model="date2">
                </div>
            </div>

        </div>

    </div>
    <!-- END FILTERS -->

    <!-- BEGIN RESULT -->
    <div class="col-md-9">
        <div class="row d-print-none">
            <div class="col form-inline">
                <button class="btn btn-default mr-2" data-toggle="modal" data-target="#dateSelect">
                    <i class="fa fa-print"></i>
                </button>
                <!----- date picking modal --->
                <div class="modal fade" id="dateSelect" style="display:none" aria-modal="true" role="dialog">
                    <div class="modal-dialog ">
                        <div class="modal-content">
                            <form method="POST" action="{{ route('record.print',['type' => $type])}}">
                                @csrf
                                <div class="modal-header">
                                    <h4 class="modal-title">Select which date to print records</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group row">
                                        <label>Date From:</label>
                                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                            <input type="date" class="form-control datetimepicker-input"
                                                name="printDate1">
                                            <div class="input-group-append" data-target="#reservationdate"
                                                data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label>Date To:</label>
                                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                            <input type="date" class="form-control datetimepicker-input"
                                                name="printDate2">
                                            <div class="input-group-append" data-target="#reservationdate"
                                                data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                        <small class="float-right"></small>
                                    </div>
                                    <div class="row">
                                        <small class="float-right"> *Leave blank for if you want to print today's
                                            record</small>
                                    </div>
                                </div>

                                <div class="modal-footer justify-content-between">
                                    <input type="submit" class="btn btn-primary" value="Print">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <select class="form-control mr-2" wire:model="fiscal_year">
                    @for($year = 2022; $year <= date('Y'); $year++) <option>{{$year .' - '. $year+1}}</option>
                        @endfor
                </select>

                <div class="form-search" style="width:200px">
                    <i class="fa fa-search"></i>
                    <input type="text" name="table_search" class="form-control form-input" placeholder="འཚོལ།"
                        wire:model="search">
                </div>


                <button type="button" class="btn btn-default btn-sm" data-target="#addToFolder" data-toggle="modal"
                    @if(!count($selected)) disabled @endif>
                    <i class="fas fa-folder-plus"></i> ཡིག་ཁུག་ཏུ་བླུགས།
                </button>
                @livewire('add-to-folder',['myOrgs'=>$myOrgs])

                <div class="material-switch pull-right ml-4 d-flex justify-content-start align-items-center">
                    <input class="align-self-end" id="someSwitchOptionPrimary" wire:model="showAccess" value="true"
                        type="checkbox" />
                    <label for="someSwitchOptionPrimary" class="label-primary bg-info"></label>
                    <div class="ml-2 small">{{$type=== 'outgoing' ? 'ངས་བཏང་བ།' : 'ང་ལ་འབྱོར་བ།' }}</div>
                </div>
            </div>
            <div class="col">
                {{ $messages->links('vendor.pagination.custom') }}
            </div>
        </div>

        <div class="table-responsive">
            @include('record.partials.table',compact('type','messages'))
        </div>
        <div class="mt-1">
            {{ $messages->links('vendor.pagination.custom') }}
        </div>

    </div>
</div>