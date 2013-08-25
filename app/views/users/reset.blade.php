<div id="reset_user" class="modal hide fade">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3>Are you sure?</h3>
    </div>
    <div class="modal-body">
        <p>Are you sure you want to reset this user's password?</p>
    </div>
    <div class="modal-footer">
        <a class="btn btn-success" href="{{ URL::route('users.reset', array('users' => $user->getId())) }}" data-token="{{ Session::getToken() }}" data-method="POST">Yes</a>
        <button class="btn btn-danger" data-dismiss="modal">No</button>
    </div>
</div>
