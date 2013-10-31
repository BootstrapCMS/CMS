<div class="well clearfix">
    @if (Sentry::check() && Sentry::getUser()->hasAccess('mod'))
        <div class="col-md-10 col-sm-9">
            <p>
                <strong>{{ $comment->getUserName() }}</strong> - <abbr class="timeago" title="{{ $comment->getCreatedAt()->toISO8601String() }}">{{ $comment->getCreatedAt()->toDateTimeString() }}</abbr>
            </p>
            <p>
                <a href="#" id="editable_comment_{{ $comment->getId() }}" class="x-editable" data-type="textarea" data-inputclass="form-control comment-box col-sm-8" data-placeholder="Type a comment..." data-rows="3" data-pk="{{ $comment->getId() }}" data-url="{{ URL::route('blog.posts.comments.update', array('posts' => $post_id, 'comments' => $comment->getId())) }}" data-title="Modify comment">{{ nl2br(e($comment->getBody())) }}</a>
            </p>
        </div>
        <div class="hidden-xs">
            <div class="col-md-2 col-sm-3">
                <div class="pull-right">
                    <a class="btn btn-danger" href="#delete_comment_{{ $comment->getId() }}" data-toggle="modal" data-target="#delete_comment_{{ $comment->getId() }}"><i class="fa fa-times"></i> Delete</a>
                </div>
            </div>
        </div>
        <div class="visible-xs">
            <div class="col-sm-12">
                <a class="btn btn-danger" href="#delete_comment_{{ $comment->getId() }}" data-toggle="modal" data-target="#delete_comment_{{ $comment->getId() }}"><i class="fa fa-times"></i> Delete</a>
            </div>
        </div>
    @else
        <div class="col-sm-12">
            <p>
                <strong>{{ $comment->getUserName() }}</strong> - <abbr class="timeago" title="{{ $comment->getCreatedAt()->toISO8601String() }}">{{ $comment->getCreatedAt()->toDateTimeString() }}</abbr>
            </p>
            <p>
                {{ nl2br(e($comment->getBody())) }}
            </p>
        </div>
    @endif
</div>
