<div>
    <div class="btn-group">
        <button type="button" class="btn btn-default btn-sm" data-container="body" title="Pull Back"
                data-placement="bottom" data-toggle="modal" data-target="#exampleModal">
            <i class="fas fa-undo align-middle"></i>
        </button>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pull Back Request</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="unsent" method="POST">

                    <div class="modal-body">
                        <p> This message is already sent, but you can send a Pull Back Request.</p>
                        <p> A Pull Back request for a message can be sent if the message was sent in the last 24
                            hours. </p>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Please give reason for pulling back this
                                message:</label>
                            <textarea class="form-control" id="message-text" required
                                      wire:model.defer="reason"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Sent</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
