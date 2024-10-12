<button type="button" class="btn btn-default btn-file" data-toggle="modal" data-target="#attach-files">
    <i class="fas fa-paperclip"></i> Attach Files
</button>

<div class="modal fade" id="attach-files" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-toggle="tab" data-target="#your-files" type="button" role="tab" aria-controls="home" aria-selected="true">Your Files</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link " id="home-tab" data-toggle="tab" data-target="#shared-with-you" type="button" role="tab" aria-controls="home" aria-selected="true">Shared With You</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-toggle="tab" data-target="#upload-files" type="button" role="tab" aria-controls="profile" aria-selected="false">Upload Files</button>
                    </li>   
                </ul>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="your-files" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="card card-dark">
                            <div class="card-header">
                                <h4 class="card-title">Your uploaded files</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <a href="https://via.placeholder.com/1200/FFFFFF.png?text=1" data-toggle="lightbox" data-title="sample 1 - white" data-gallery="gallery">
                                            <img src="https://via.placeholder.com/300/FFFFFF?text=1" class="img-fluid mb-2" alt="white sample">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade show  py-2" id="shared-with-you" role="tabpanel" aria-labelledby="home-tab">
                        <div class="card card-dark">
                            <div class="card-header">
                                <h4 class="card-title">Files shared with you</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <a href="https://via.placeholder.com/1200/FFFFFF.png?text=1" data-toggle="lightbox" data-title="sample 1 - white" data-gallery="gallery">
                                            <img src="https://via.placeholder.com/300/FFFFFF?text=1" class="img-fluid mb-2" alt="white sample">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade py-3" id="upload-files" role="tabpanel" aria-labelledby="profile-tab">
                      
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

