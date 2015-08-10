<div id="comment_{!! $comment->id !!}" class="well clearfix col-xs-12 animated bounceIn{!! rand(0, 1) ? 'Left': 'Right' !!}" data-pk="{!! $comment->id !!}" data-ver="{!! $comment->version !!}">
    @auth('mod')
        <div class="col-md-9 col-sm-8">
            <p><strong>{!! $comment->author !!}</strong> - {!! html_ago($comment->created_at, 'timeago_comment_'.$comment->id) !!}</p>
            <p id="main_comment_{!! $comment->id !!}" class="main">{!! nl2br(e($comment->body)) !!}</p>
        </div>
        <div class="hidden-xs">
            <div class="col-md-3 col-sm-4">
                <div class="pull-right">
                    <a id="editable_comment_{!! $comment->id !!}_1" class="btn btn-info editable" href="#edit_comment" data-pk="{!! $comment->id !!}"><i class="fa fa-pencil-square-o"></i> Edit</a> <a id="deletable_comment_{!! $comment->id !!}_1" class="btn btn-danger deletable" href="{!! URL::route('blog.posts.comments.destroy', array('posts' => $post_id, 'comments' => $comment->id)) !!}"><i class="fa fa-times"></i> Delete</a>
                </div>
            </div>
        </div>
        <div class="visible-xs">
            <div class="col-xs-12">
                <a id="editable_comment_{!! $comment->id !!}_2" class="btn btn-info editable" href="#edit_comment" data-pk="{!! $comment->id !!}"><i class="fa fa-pencil-square-o"></i> Edit</a> <a id="deletable_comment_{!! $comment->id !!}_2" class="btn btn-danger deletable" href="{!! URL::route('blog.posts.comments.destroy', array('posts' => $post_id, 'comments' => $comment->id)) !!}"><i class="fa fa-times"></i> Delete</a>
            </div>
        </div>
    @else
        <div class="col-xs-12">
            <p><strong>{!! $comment->author !!}</strong> - {!! html_ago($comment->created_at, 'timeago_comment_'.$comment->id) !!}</p>
            <p id="main_comment_{!! $comment->id !!}" class="main">{!! nl2br(e($comment->body)) !!}</p>
        </div>
    @endauth
</div>
