
<div id="editEmployeeModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <form id="editForm" method="POST" action="{{ route('manage-staff.edit') }}"
                    oninput='password_confirmation.setCustomValidity(password.value !== password_confirmation.value ? "Passwords do not match." : "")'>
                    @csrf

                    <div class="modal-header">
                        <h4 class="modal-title">ལས་བྱེད་ནོར་བཅོས།</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>མིང་།</label><span class="text-danger">*</span>

                                    <input id="editName" type="text" class="form-control" required name="name">

                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>སྤྱོད་མིང་ངོ་རྟགས།</label><span class="text-danger">*</span>

                                    <input id="editEmail" type="text" class="form-control" required name="email">

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>{{ __('གསང་ཚིག') }}</label>
                                    <input type="password" class="form-control" name="password">
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label>{{ __('གསང་ཚིག་གཏན་འཁེལ།') }}</label>
                                    <input type="password" class="form-control" name="password_confirmation">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>གནས་རིམ།</label>
                                    <select id="editPosition" name="position_id" class="form-control">
                                        <option value=""> </option>
                                        @foreach($positions as $pos)
                                        <option value={{ $pos->id }}>{{ $pos->name_tibetan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>ལས་ཁུང་འདེམས།</label>
                                    <x-section-tree-dropdown id="orgTreeSelectEdit" :orgs="$orgs" name="works_at"/>           
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <input type="button" class="btn btn-secondary" data-dismiss="modal" value="དོར།">
                        <input type="submit" class="btn btn-primary" value="ཡར་ཆུགས་བྱོས།">
                    </div>
                </form>
            </div>
        </div>
    </div>