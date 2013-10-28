<div id="reset_user" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Are you sure?</h4>
            </div>
            <div class="modal-body">
                <p>You are about to reset this user's password. They will receive and email with their new password.</p>
                <p>Are you sure you wish to continue?</p>
            </div>
            <div class="modal-footer">
                <a class="btn btn-success" href="{{ URL::route('users.reset', array('users' => $user->getId())) }}" data-token="{{ Session::getToken() }}" data-method="POST">Yes</a>
                <button class="btn btn-danger" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>
