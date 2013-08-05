@foreach ($comments as $comment)
    <div id="edit_comment_{{ $comment->getId() }}" class="modal hide fade">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">×</button>
            <h3>Editing Comment?</h3>
        </div>
        <div class="modal-body">
            <p>FORM AND SHIT...</p>
        </div>
        <div class="modal-footer">
            BUTTONS HERE...
        </div>
    </div>
    <div id="delete_comment_{{ $comment->getId() }}" class="modal hide fade">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">×</button>
            <h3>Are you sure?</h3>
        </div>
        <div class="modal-body">
            <p>Are you sure you want to delete this comment?</p>
        </div>
        <div class="modal-footer">
            <a class="btn btn-success" href="{{ URL::route('blog.posts.comments.destroy', array('posts' => $post->getId(), 'comments' => $comment->getId())) }}" data-token="{{ Session::getToken() }}" data-method="DELETE">Yes</a>
            <button class="btn btn-danger" data-dismiss="modal">No</button>
        </div>
    </div>
@endforeach
