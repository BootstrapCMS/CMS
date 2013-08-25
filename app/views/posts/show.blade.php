@extends('layouts.default')

@section('title')
{{ $post->getTitle() }}
@stop

@section('controls')
@if (Sentry::check() && Sentry::getUser()->hasAccess('blog'))
    <div class="well clearfix">
        <div class="span6">
            <p>
                <strong>Post Creator:</strong> {{ $post->getUserEmail() }}
            </p>
            <a class="btn btn-info" href="{{ URL::route('blog.posts.edit', array('posts' => $post->getId())) }}"><i class="icon-edit"></i> Edit Post</a> <a class="btn btn-danger" href="#delete_post" data-toggle="modal" data-target="#delete_post"><i class="icon-remove"></i> Delete Post</a>
        </div>
        <div class="span5">
            <div class="pull-right">
                <p>
                    <em>Post Created: {{ $post->getCreatedAt()->diffForHumans() }}</em>
                </p>
                <p>
                    <em>Last Updated: {{ $post->getUpdatedAt()->diffForHumans() }}</em>
                </p>
            </div>
        </div>
    </div>
    <hr>
@endif

<div class="row-fluid">
    <div class="span12">
        <div class="span8">
            <p class="lead">
                {{ $post->getSummary() }}
            </p>
        </div>
        <div class="span4">
            <div class="pull-right">
                <p>
                    Author: {{ $post->getUserName() }}
                </p>
            </div>
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
    <div class="row-fluid">
        <div class="span12">
            {{ Form::open(array('url' => URL::route('blog.posts.comments.store', array('posts' => $post->getId())), 'method' => 'POST', 'class' => 'form-vertical')) }}

                <div class="control-group">
                    <div class="controls">
                        <textarea id="body" name="body" class="span12, comment-box" placeholder="Type a comment..." rows="3"></textarea>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <button id="contact-submit" type="submit" class="btn btn-primary"><i class="icon-comment"></i> Post Comment</button>
                    </div>
                </div>
            {{ Form::close() }}
        </div>
    <br>
    </div>
@else
<p>
    <strong>Please <a href="{{ URL::route('account.login') }}">login</a> or <a href="{{ URL::route('account.register') }}">register</a> to post a comment.</strong>
</p>
@endif
<br>

@if (count($comments) == 0)
<p>There are currently no comments.</p>
@else
    @foreach ($comments as $comment)
        <div class="well">
            <div class="row-fluid">
                <div class="span12">
                    <div class="span9">
                        <p>
                            <strong>{{ $comment->getUserName() }}</strong> - {{ $comment->getCreatedAt()->diffForHumans() }}
                        </p>
                        <p>
                            {{ nl2br(e($comment->getBody())) }}
                        </p>
                    </div>
                    <div class="span3">
                        @if (Sentry::check() && Sentry::getUser()->hasAccess('mod'))
                            <div class="pull-right">
                                <a class="btn btn-info" href="#edit_comment_{{ $comment->getId() }}" data-toggle="modal" data-target="#edit_comment_{{ $comment->getId() }}"><i class="icon-edit"></i> Edit</a> <a class="btn btn-danger" href="#delete_comment_{{ $comment->getId() }}" data-toggle="modal" data-target="#delete_comment_{{ $comment->getId() }}"><i class="icon-remove"></i> Delete</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif
@stop

@section('messages')
@if (Sentry::check() && Sentry::getUser()->hasAccess('blog'))
    @include('posts.delete')
@endif
@if (Sentry::check() && Sentry::getUser()->hasAccess('mod'))
    @include('posts.comments')
@endif
@stop
