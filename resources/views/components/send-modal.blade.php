<div class="modal fade" tabindex="-1" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Send to user</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Enter receiver's email address</p>
                <form action="{{ route('sendContact') }}" method="POST">
                    @csrf
                    <div class="hide-input"></div>
                    <div class="input-group mb-3">
                        <input type="email" required class="form-control" placeholder="Recipient's username"
                            name="receiver_email">
                        <button class="btn btn-success"><i class="bi bi-send-plus text-light"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
