<div id="deleteSingleEmployeeModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="deleteSingleStaffForm" method="POST" action="{{ route('manage-staff.delete') }}">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h4 class="modal-title">ལས་བྱེད་སུབས།</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <p id="deleteSingleStaffMessage" style="font-weight: bold">ཁྱེད་ཀྱིས་ལས་བྱེད་འདི་བསུབ་རྒྱུ་གཏན་ཁེལ་ཡིན་ནམ།</p>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="དོར།">
                    <input type="submit" class="btn btn-danger" value="སུབས།">
                </div>
            </form>
        </div>
    </div>
</div>