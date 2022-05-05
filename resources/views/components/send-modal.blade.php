<div class="modal" tabindex="-1" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Send to user</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Enter receiver's email address</p>
                <form action="">
                    <input type="hidden" value="{{ $contactId }}">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Recipient's username"
                            aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <button class="btn btn-success"><i class="bi bi-send-plus text-light"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
