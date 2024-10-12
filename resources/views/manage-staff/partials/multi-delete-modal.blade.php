<div id="deleteEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="deleteStaffForm" method="POST" action="{{ route('manage-staff.delete') }}">
                    @csrf
                    @method('DELETE')
                    <!-- <input id="toDeleteStaff" type="hidden" name="staffList[]" value="">			 -->
                    <div class="modal-header">
                        <h4 class="modal-title">ལས་བྱེད་སུབས།</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p id="deleteStaffMessage" style="font-weight: bold">ལས་བྱེད་བསུབ་རྒྱུ་མིན་འདུག</p>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="དོར།">
                        <input id="deleteStaffSubmitBtn" type="submit" disabled="disabled" class="btn btn-danger"
                            value="སུབས།">
                    </div>
                </form>
            </div>
        </div>
    </div>