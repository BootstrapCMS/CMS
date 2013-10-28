@foreach ($comments as $comment)
    <div id="delete_comment_{{ $comment->getId() }}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Are you sure?</h4>
                </div>
                <div class="modal-body">
                    <p>
                        You are about to delete this comment. This process cannot be undone.
                    </p>
                    <p>Are you sure you wish to continue?</p>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-success" href="{{ URL::route('blog.posts.comments.destroy', array('posts' => $post->getId(), 'comments' => $comment->getId())) }}" data-token="{{ Session::getToken() }}" data-method="DELETE">Yes</a>
                    <button class="btn btn-danger" data-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>
@endforeach
