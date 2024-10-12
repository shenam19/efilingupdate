<!-- Add Modal HTML -->
<div id="addEmployeeModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ route('manage-staff.store') }}"
                    oninput='password_confirmation.setCustomValidity(password.value !== password_confirmation.value ? "Passwords do not match." : "")'>
                    @csrf

                    <div class="modal-header">
                        <h4 class="modal-title" >ལས་བྱེད་གསར་པ་ཆུགས།</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>མིང་།</label><span class="text-danger">*</span>

                                    <input type="text" class="form-control" required name="name">

                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label  data-toggle="tooltip" data-placement="top" title="Email">སྤྱོད་མིང་ངོ་རྟགས།</label><span class="text-danger">*</span>

                                    <input type="text" class="form-control" required name="email">

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>{{ __('གསང་ཚིག') }}</label><span class="text-danger">*</span>
                                    <input type="password" class="form-control" required name="password">
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label>{{ __('གསང་ཚིག་གཏན་འཁེལ།') }}</label><span class="text-danger">*</span>
                                    <input type="password" class="form-control" required name="password_confirmation">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>གནས་རིམ།</label>
                                    <select name="position_id" class="form-control">
                                        <option></option>
                                        @foreach($positions as $pos)
                                        <option value={{ $pos->id }}>{{ $pos->name_tibetan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>ལས་ཁུང་འདེམས།</label>
                                    <x-section-tree-dropdown id="orgTreeSelectAdd" :orgs="$orgs" name="works_at"/>     
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
