<div id="delete_account" class="modal hide fade">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3>Are you sure?</h3>
    </div>
    <div class="modal-body">
        <p>
            You are about to delete your account and all your content including any pages, posts, events, or comments you might own! This process cannot be undone.
        </p>
        <p>Are you sure you wish to continue?</p>
    </div>
    <div class="modal-footer">
        <a class="btn btn-success" href="{{ URL::route('account.profile.delete') }}" data-token="{{ Session::getToken() }}" data-method="DELETE">Yes</a>
        <button class="btn btn-danger" data-dismiss="modal">No</button>
    </div>
</div>
