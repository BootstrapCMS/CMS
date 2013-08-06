@foreach ($comments as $comment)
    <div id="edit_comment_{{ $comment->getId() }}" class="modal hide fade">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">×</button>
            <h3>Edit Comment</h3>
        </div>
        {{ Form::open(array('url' => URL::route('blog.posts.comments.update', array('posts' => $post->getId(), 'comments' => $comment->getId())), 'method' => 'PATCH', 'class' => 'form-vertical')) }}
            <div class="modal-body">
                <div class="control-group">
                    <div class="controls">
                        <input name="body" value="{{{ $comment->getBody() }}}" type="text" class="input-xlarge" placeholder="Type a comment...">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="control-group">
                    <div class="controls">
                        <button class="btn btn-success" type="submit">Update</button>
                        <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        {{ Form::close() }}
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
