<div id="editOrgModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editOrgModalTitle"
        aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-header">

                        <h5 class="modal-title " id="deleteModalTitle">གནས་ཚུལ་ཞིབ་ཕྲ།</h5>
                        <form id="deleteOrgForm" action="{{ route('organization-structure.delete')}}" onsubmit="return confirm('Deleting this section will delete all the sub sections. All the users in this section will be promoted to the parent organization. All the messages sent to or by this section will be promoted to the parent organization. And all the folder in this section will be promoted to the parent organization. Do you really want to delete this seciton?');" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-outline-danger" type="submit"><i class="fa fa-times"></i> སུབས།</button>
                        </form>

                </div>
                <form id="editOrgForm" action="{{ route('organization-structure.edit')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nameShortInput">བསྡུས་མིང་།</label>
                            <input id="nameShortInput" type="text" class="form-control" placeholder="བསྡུས་མིང་།"
                                name="name_short" required>
                        </div>

                        <div class="form-group">
                            <label for="fullNameInput">མིང་ཆ་ཚང་།</label>
                            <input id="fullNameInput" type="text" class="form-control" placeholder="full name"
                                name="name" required>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary mr-auto" data-dismiss="modal"
                            data-toggle="modal" data-target="#addChildModal"><i class="fa fa-plus"></i> ནང་གསེས་གསར་བཟོ་བྱོས།</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">སྒོ་རྒྱག</button>
                        <button type="submit" class="btn btn-primary">གསོག་འཇོག</button>
                    </div>
                </form>
            </div>
        </div>
    </div>