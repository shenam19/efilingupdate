<!----- date range picking modal --->
<div class="modal fade" id="dateSelect" style="display:none" aria-modal="true" role="dialog">
    <div class="modal-dialog ">
        <div class="modal-content">
            <form method="POST" action="{{$route}}">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">{{$title}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label>Date From:</label>
                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                            <input type="date" class="form-control datetimepicker-input" name="printDate1">
                            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label>Date To:</label>
                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                            <input type="date" class="form-control datetimepicker-input" name="printDate2">
                            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
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