@extends(Config::get('views.default', 'layouts.default'))

@section('title')
{{{ $post->title }}}
@stop

@section('top')
<div class="page-header">
<h1>{{{ $post->title }}}</h1>
</div>
@stop

@section('content')
@if (Credentials::check() && Credentials::hasAccess('blog'))
    <div class="well clearfix">
        <div class="hidden-xs">
            <div class="col-xs-6">
                <p>
                    <strong>Post Creator:</strong> {{ $post->user()->first(array('email'))->email }}
                </p>
                <a class="btn btn-info" href="{{ URL::route('blog.posts.edit', array('posts' => $post->id)) }}"><i class="fa fa-pencil-square-o"></i> Edit Post</a> <a class="btn btn-danger" href="#delete_post" data-toggle="modal" data-target="#delete_post"><i class="fa fa-times"></i> Delete Post</a>
            </div>
            <div class="col-xs-6">
                <div class="pull-right">
                    <p>
                        <em>Post Created: <abbr class="timeago" title="{{ $post->created_at->toISO8601String() }}">{{ $post->created_at->toDateTimeString() }}</abbr></em>
                    </p>
                    <p>
                        <em>Last Updated: <abbr class="timeago" title="{{ $post->updated_at->toISO8601String() }}">{{ $post->updated_at->toDateTimeString() }}</abbr></em>
                    </p>
                </div>
            </div>
        </div>
        <div class="visible-xs">
            <div class="col-xs-12">
                <p>
                    <strong>Post Creator:</strong> {{ $post->user()->first(array('email'))->email }}
                </p>
                <p>
                    <strong>Post Created:</strong> <abbr class="timeago" title="{{ $post->created_at->toISO8601String() }}">{{ $post->created_at->toDateTimeString() }}</abbr>
                </p>
                <p>
                    <strong>Last Updated:</strong> <abbr class="timeago" title="{{ $post->updated_at->toISO8601String() }}">{{ $post->updated_at->toDateTimeString() }}</abbr>
                </p>
                <a class="btn btn-info" href="{{ URL::route('blog.posts.edit', array('posts' => $post->id)) }}"><i class="fa fa-pencil-square-o"></i> Edit Post</a> <a class="btn btn-danger" href="#delete_post" data-toggle="modal" data-target="#delete_post"><i class="fa fa-times"></i> Delete Post</a>
            </div>
        </div>
    </div>
    <hr>
@endif

<div class="row">
    <div class="hidden-xs">
        <div class="col-md-8 col-xs-6">
            <p class="lead">{{ $post->summary }}</p>
        </div>
        <div class="col-md-4 col-xs-6">
            <div class="pull-right">
                <p>Author: {{ $post->user()->first(array('first_name', 'last_name'))->getName() }}</p>
            </div>
        </div>
    </div>
    <div class="visible-xs">
        <div class="col-xs-12">
            <p class="lead">{{ $post->summary }}</p>
            <p>Author: {{ $post->user()->first(array('first_name', 'last_name'))->getName() }}</p>
        </div>
    </div>
</div>
<br>

{{ Markdown::render($post->body) }}
<br><hr>

<h3>Comments</h3>
@if (Credentials::check() && Credentials::hasAccess('user'))
    <br>
    <div class="row">
        {{ Form::open(array('id' => 'commentform', 'url' => URL::route('blog.posts.comments.store', array('posts' => $post->id)), 'method' => 'POST', 'class' => 'form-vertical')) }}
            <div class="form-group">
                <div class="col-xs-12">
                    <textarea id="body" name="body" class="form-control comment-box" placeholder="Type a comment..." rows="3"></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <button id="contact-submit" type="submit" class="btn btn-primary"><i class="fa fa-comment"></i> Post Comment</button> <label id="commentstatus"></label>
                </div>
            </div>
        {{ Form::close() }}
    </div>
    <br>
@else
<p>
    @if (Config::get('graham-campbell/credentials::regallowed'))
        <strong>Please <a href="{{ URL::route('account.login') }}">login</a> or <a href="{{ URL::route('account.register') }}">register</a> to post a comment.</strong>
    @else
        <strong>Please <a href="{{ URL::route('account.login') }}">login</a> to post a comment.</strong>
    @endif
</p>
@endif
<br>

<?php $post_id = $post->id; ?>
<div id="comments" data-url="{{ URL::route('blog.posts.comments.index', array('posts' => $post_id)) }}">
    @if (count($comments) == 0)
    <p id="nocomments">There are currently no comments.</p>
    @else
        @foreach ($comments as $comment)
            @include('posts.comment')
        @endforeach
    @endif
</div>
@stop

@section('bottom')
@if (Credentials::check() && Credentials::hasAccess('blog'))
@include('posts.delete')
@endif
@if (Credentials::check() && Credentials::hasAccess('mod'))
<div id="edit_comment" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Edit Comment</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    {{ Form::open(array('id' => 'edit_commentform', 'method' => 'PATCH', 'class' => 'form-vertical', 'data-pk' => '0')) }}
                        <input id="verion" name="version" value="1" type="hidden">
                        <div class="form-group">
                            <div class="col-xs-12">
                                <textarea id="edit_body" name="edit_body" class="form-control comment-box" placeholder="Type a comment..." rows="3"></textarea>
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
            <div class="modal-footer">
                <button id="edit_comment_cancel" type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button id="edit_comment_ok" type="button" class="btn btn-primary">OK</button>
            </div>
        </div>
    </div>
</div>
@endif
@stop

@section('css')]
{{ HTML::style('//cdnjs.cloudflare.com/ajax/libs/animate.css/3.0.0/animate.min.css') }}
{{ Asset::styles('form') }}
@stop

@section('js')
{{ Asset::scripts('form') }}
{{ HTML::script('//cdnjs.cloudflare.com/ajax/libs/jquery.form/3.49/jquery.form.min.js') }}
<script>
var cmsCommentInterval = {{ Config::get('cms.commentfetch') }};
var cmsCommentTime = {{ Config::get('cms.commenttrans') }};
</script>
{{ Asset::scripts('comment') }}
@stop
