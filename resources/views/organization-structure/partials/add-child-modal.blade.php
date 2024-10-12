<div id="addChildModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addOrgModalTitle"
        aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form id="addChildForm" action="{{ route('organization-structure.add')}}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addChildModalTitle">ནང་གསེས་གསར་བཟོ་བྱོས།</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="addNameShortInput">བསྡུས་མིང་།</label>
                            <input id="addNameShortInput" type="text" class="form-control" placeholder="བསྡུས་མིང་།"
                                name="name_short" required>
                        </div>
                        <div class="form-group">
                            <label for="addFullNameInput">མིང་ཆ་ཚང་།</label>
                            <input id="addFullNameInput" type="text" class="form-control" placeholder="མིང་ཆ་ཚང་།"
                                name="name" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">སྒོ་རྒྱག</button>
                        <button type="submit" class="btn btn-primary">གསོག་འཇོག</button>
                    </div>
                </form>
            </div>
        </div>
    </div>