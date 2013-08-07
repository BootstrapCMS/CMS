<div id="delete_account" class="modal hide fade">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3>Are you sure?</h3>
    </div>
    <div class="modal-body">
        <p>Are you sure you want to delete your account and all your content including any pages, posts, events, or comments you might own?</p>
    </div>
    <div class="modal-footer">
        <a class="btn btn-success" href="{{ URL::route('account.profile.delete') }}" data-token="{{ Session::getToken() }}" data-method="DELETE">Yes</a>
        <button class="btn btn-danger" data-dismiss="modal">No</button>
    </div>
</div>
