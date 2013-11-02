<div id="comment_{{ $comment->getId() }}" class="well clearfix" data-pk="{{ $comment->getId() }}" data-ver="{{ $comment->getVersion() }}">
    @if (Sentry::check() && Sentry::getUser()->hasAccess('mod'))
        <div class="col-md-10 col-sm-9">
            <p>
                <strong>{{ $comment->getUserName() }}</strong> - <abbr id="timeago_comment_{{ $comment->getId() }}" class="timeago" title="{{ $comment->getCreatedAt()->toISO8601String() }}">{{ $comment->getCreatedAt()->toDateTimeString() }}</abbr>
            </p>
            <p id="editable_comment_{{ $comment->getId() }}" class="editable" data-pk="{{ $comment->getId() }}" data-ver="{{ $comment->getVersion() }}" data-url="{{ URL::route('blog.posts.comments.update', array('posts' => $post_id, 'comments' => $comment->getId())) }}">{{ nl2br(e($comment->getBody())) }}</p>
        </div>
        <div class="hidden-xs">
            <div class="col-md-2 col-sm-3">
                <div class="pull-right">
                    <a id="deletable_comment_{{ $comment->getId() }}_1" class="btn btn-danger deletable" href="{{ URL::route('blog.posts.comments.destroy', array('posts' => $post_id, 'comments' => $comment->getId())) }}"><i class="fa fa-times"></i> Delete</a>
                </div>
            </div>
        </div>
        <div class="visible-xs">
            <div class="col-sm-12">
                <a id="deletable_comment_{{ $comment->getId() }}_2" class="btn btn-danger deletable" href="{{ URL::route('blog.posts.comments.destroy', array('posts' => $post_id, 'comments' => $comment->getId())) }}"><i class="fa fa-times"></i> Delete</a>
            </div>
        </div>
    @else
        <div class="col-sm-12">
            <p>
                <strong>{{ $comment->getUserName() }}</strong> - <abbr id="timeago_comment_{{ $comment->getId() }}" class="timeago" title="{{ $comment->getCreatedAt()->toISO8601String() }}">{{ $comment->getCreatedAt()->toDateTimeString() }}</abbr>
            </p>
            <p>
                {{ nl2br(e($comment->getBody())) }}
            </p>
        </div>
    @endif
</div>
