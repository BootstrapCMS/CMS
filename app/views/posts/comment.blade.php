<div id="comment_{{ $comment->getId() }}" class="well clearfix" data-pk="{{ $comment->getId() }}" data-ver="{{ $comment->getVersion() }}">
    @if (Sentry::check() && Sentry::getUser()->hasAccess('mod'))
        <div class="col-md-9 col-sm-8">
            <p><strong>{{ $comment->getUserName() }}</strong> - <abbr id="timeago_comment_{{ $comment->getId() }}" class="timeago" title="{{ $comment->getCreatedAt()->toISO8601String() }}">{{ $comment->getCreatedAt()->toDateTimeString() }}</abbr></p>
            <p id="main_comment_{{ $comment->getId() }}" class="main">{{ nl2br(e($comment->getBody())) }}</p>
        </div>
        <div class="hidden-xs">
            <div class="col-md-3 col-sm-4">
                <div class="pull-right">
                    <a id="editable_comment_{{ $comment->getId() }}_1" class="btn btn-info editable" href="#edit_comment" data-pk="{{ $comment->getId() }}"><i class="fa fa-pencil-square-o"></i> Edit</a> <a id="deletable_comment_{{ $comment->getId() }}_1" class="btn btn-danger deletable" href="{{ URL::route('blog.posts.comments.destroy', array('posts' => $post_id, 'comments' => $comment->getId())) }}"><i class="fa fa-times"></i> Delete</a>
                </div>
            </div>
        </div>
        <div class="visible-xs">
            <div class="col-xs-12">
                <a id="editable_comment_{{ $comment->getId() }}_2" class="btn btn-info editable" href="#edit_comment" data-pk="{{ $comment->getId() }}"><i class="fa fa-pencil-square-o"></i> Edit</a> <a id="deletable_comment_{{ $comment->getId() }}_2" class="btn btn-danger deletable" href="{{ URL::route('blog.posts.comments.destroy', array('posts' => $post_id, 'comments' => $comment->getId())) }}"><i class="fa fa-times"></i> Delete</a>
            </div>
        </div>
    @else
        <div class="col-xs-12">
            <p><strong>{{ $comment->getUserName() }}</strong> - <abbr id="timeago_comment_{{ $comment->getId() }}" class="timeago" title="{{ $comment->getCreatedAt()->toISO8601String() }}">{{ $comment->getCreatedAt()->toDateTimeString() }}</abbr></p>
            <p id="main_comment_{{ $comment->getId() }}" class="main">{{ nl2br(e($comment->getBody())) }}</p>
        </div>
    @endif
</div>
