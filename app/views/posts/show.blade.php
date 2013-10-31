@extends('layouts.default')

@section('title')
{{ $post->getTitle() }}
@stop

@section('controls')
@if (Sentry::check() && Sentry::getUser()->hasAccess('blog'))
    <div class="well clearfix">
        <div class="hidden-xs">
            <div class="col-sm-6">
                <p>
                    <strong>Post Creator:</strong> {{ $post->getUserEmail() }}
                </p>
                <a class="btn btn-info" href="{{ URL::route('blog.posts.edit', array('posts' => $post->getId())) }}"><i class="fa fa-pencil-square-o"></i> Edit Post</a> <a class="btn btn-danger" href="#delete_post" data-toggle="modal" data-target="#delete_post"><i class="fa fa-times"></i> Delete Post</a>
            </div>
            <div class="col-sm-6">
                <div class="pull-right">
                    <p>
                        <em>Post Created: <abbr class="timeago" title="{{ $post->getCreatedAt()->toISO8601String() }}">{{ $post->getCreatedAt()->toDateTimeString() }}</abbr></em>
                    </p>
                    <p>
                        <em>Last Updated: <abbr class="timeago" title="{{ $post->getUpdatedAt()->toISO8601String() }}">{{ $post->getUpdatedAt()->toDateTimeString() }}</abbr></em>
                    </p>
                </div>
            </div>
        </div>
        <div class="visible-xs">
            <div class="col-xs-12">
                <p>
                    <strong>Post Creator:</strong> {{ $post->getUserEmail() }}
                </p>
                <p>
                    <strong>Post Created:</strong> <abbr class="timeago" title="{{ $post->getCreatedAt()->toISO8601String() }}">{{ $post->getCreatedAt()->toDateTimeString() }}</abbr>
                </p>
                <p>
                    <strong>Last Updated:</strong> <abbr class="timeago" title="{{ $post->getUpdatedAt()->toISO8601String() }}">{{ $post->getUpdatedAt()->toDateTimeString() }}</abbr>
                </p>
                <a class="btn btn-info" href="{{ URL::route('blog.posts.edit', array('posts' => $post->getId())) }}"><i class="fa fa-pencil-square-o"></i> Edit Post</a> <a class="btn btn-danger" href="#delete_post" data-toggle="modal" data-target="#delete_post"><i class="fa fa-times"></i> Delete Post</a>
            </div>
        </div>
    </div>
    <hr>
@endif

<div class="row">
    <div class="col-sm-9 col-xs-8">
        <p class="lead">
            {{ $post->getSummary() }}
        </p>
    </div>
    <div class="col-sm-3 col-xs-4">
        <div class="pull-right">
            <p>
                Author: {{ $post->getUserName() }}
            </p>
        </div>
    </div>
</div>
<br>
@stop

@section('content')
{{ Markdown::string($post->getBody()) }}
@stop

@section('comments')
<br><hr>
<h3>Comments</h3>
@if (Sentry::check() && Sentry::getUser()->hasAccess('user'))
    <br>
    {{ Form::open(array('id' => 'commentform', 'url' => URL::route('blog.posts.comments.store', array('posts' => $post->getId())), 'method' => 'POST', 'class' => 'form-vertical')) }}
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
    <br>
@else
<p>
    <strong>Please <a href="{{ URL::route('account.login') }}">login</a> or <a href="{{ URL::route('account.register') }}">register</a> to post a comment.</strong>
</p>
@endif
<br>

<div id="comments">
    @if (count($comments) == 0)
    <p>There are currently no comments.</p>
    @else
        <?php $post_id = $post->getId(); ?>
        @foreach ($comments as $comment)
            @include('posts.comment')
        @endforeach
    @endif
</div>
@stop

@section('messages')
@if (Sentry::check() && Sentry::getUser()->hasAccess('blog'))
@include('posts.delete')
@endif
@stop

@section('css')
@if (Sentry::check())
{{ Basset::show('form.css') }}
@endif
@stop

@section('js')
@if (Sentry::check())
{{ Basset::show('form.js') }}
<script>
$(document).ready(function() {
    $('#commentform').submit(function() {
        $(this).ajaxSubmit({ 
            dataType: 'json',
            clearForm: true,
            resetForm: true,
            timeout: 5000,
            beforeSubmit: function(formData, jqForm, options) {
                // TODO: show some kind of working indicator
                $("#commentstatus").replaceWith("<label id=\"commentstatus\"><div class=\"editable-error-block help-block\" style=\"display: block;\">Submitting comment...</div></label>");
            },
            success: function(data, status, xhr) {
                if (!xhr.responseJSON) {
                    $("#commentstatus").replaceWith("<label id=\"commentstatus\" class=\"has-error\"><div class=\"editable-error-block help-block\" style=\"display: block;\">There was an unknown error!</div></label>");
                    return;
                }
                console.log(xhr.responseJSON);
                if (xhr.responseJSON.success !== true) {
                    if (!xhr.responseJSON.msg) {
                        $("#commentstatus").replaceWith("<label id=\"commentstatus\" class=\"has-error\"><div class=\"editable-error-block help-block\" style=\"display: block;\">There was an unknown error!</div></label>");
                        return;
                    }
                    $("#commentstatus").replaceWith("<label id=\"commentstatus\" class=\"has-error\"><div class=\"editable-error-block help-block\" style=\"display: block;\">"+xhr.responseJSON.msg+"</div></label>");
                    return;
                }
                if (!xhr.responseJSON.msg) {
                    $("#commentstatus").replaceWith("<label id=\"commentstatus\" class=\"has-error\"><div class=\"editable-error-block help-block\" style=\"display: block;\">There was an unknown error!</div></label>");
                    return;
                }
                if (!xhr.responseJSON.comment) {
                    $("#commentstatus").replaceWith("<label id=\"commentstatus\" class=\"has-error\"><div class=\"editable-error-block help-block\" style=\"display: block;\">There was an unknown error!</div></label>");
                    return;
                }
                $("#commentstatus").replaceWith("<label id=\"commentstatus\" class=\"has-success\"><div class=\"editable-error-block help-block\" style=\"display: block;\">"+xhr.responseJSON.msg+"</div></label>");
                $(xhr.responseJSON.comment).prependTo('#comments').hide().slideDown(500);
                cmsTimeAgo();
                cmsEditable();
            },
            error: function(xhr, status, error) {
                if (!xhr.responseJSON) {
                    $("#commentstatus").replaceWith("<label id=\"commentstatus\" class=\"has-error\"><div class=\"editable-error-block help-block\" style=\"display: block;\">There was an unknown error!</div></label>");
                    return;
                }
                console.log(xhr.responseJSON);
                if (xhr.responseJSON.success !== true) {
                    if (!xhr.responseJSON.msg) {
                        $("#commentstatus").replaceWith("<label id=\"commentstatus\" class=\"has-error\"><div class=\"editable-error-block help-block\" style=\"display: block;\">There was an unknown error!</div></label>");
                        return;
                    }
                    $("#commentstatus").replaceWith("<label id=\"commentstatus\" class=\"has-error\"><div class=\"editable-error-block help-block\" style=\"display: block;\">"+xhr.responseJSON.msg+"</div></label>");
                    return;
                }
                $("#commentstatus").replaceWith("<label id=\"commentstatus\" class=\"has-error\"><div class=\"editable-error-block help-block\" style=\"display: block;\">There was an unknown error!</div></label>");
            }
        });
        return false;
    });

    $('.deletable').click(function() {
        $.ajax({
            url: $(this).attr('href'),
            type: 'DELETE',
            dataType: 'json',
            timeout: 5000,
            beforeSend: function(xhr, settings) {
                // TODO: show some kind of working indicator
                console.log('deleting...')
            },
            success: function(data, status, xhr) {
                console.log('delete successful');
                if (!xhr.responseJSON) {
                    // TODO
                    return;
                }
                console.log(xhr.responseJSON);
                $('#comment_'+xhr.responseJSON.comment).slideUp(500, function() {
                    $(this).remove();
                });
            },
            error: function(xhr, status, error) {
                console.log('delete failed');
                if (!xhr.responseJSON) {
                    // TODO
                    return;
                }
                console.log(xhr.responseJSON);
            }
        });  
    }
});
</script>
@endif
@stop
