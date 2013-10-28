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
    {{ Form::open(array('url' => URL::route('blog.posts.comments.store', array('posts' => $post->getId())), 'method' => 'POST', 'class' => 'form-vertical')) }}
        <div class="form-group">
            <div class="col-xs-12">
                <textarea id="body" name="body" class="form-control comment-box" placeholder="Type a comment..." rows="3"></textarea>
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-12">
                <button id="contact-submit" type="submit" class="btn btn-primary"><i class="fa fa-comment"></i> Post Comment</button>
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

@if (count($comments) == 0)
<p>There are currently no comments.</p>
@else
    @foreach ($comments as $comment)
        <div class="well clearfix">
            @if (Sentry::check() && Sentry::getUser()->hasAccess('mod'))
                <div class="col-md-10 col-sm-9">
                    <p>
                        <strong>{{ $comment->getUserName() }}</strong> - <abbr class="timeago" title="{{ $comment->getCreatedAt()->toISO8601String() }}">{{ $comment->getCreatedAt()->toDateTimeString() }}</abbr>
                    </p>
                    <p>
                        <a href="#" id="editable_comment_{{ $comment->getId() }}" class="x-editable" data-type="textarea" data-inputclass="form-control comment-box col-sm-8" data-placeholder="Type a comment..." data-rows="3" data-pk="{{ $comment->getId() }}" data-url="{{ URL::route('blog.posts.comments.update', array('posts' => $post->getId(), 'comments' => $comment->getId())) }}" data-title="Modify comment">{{ nl2br(e($comment->getBody())) }}</a>
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

@section('css')
@if (Sentry::check())
{{ Basset::show('form.css') }}
@endif
@stop

@section('js')
@if (Sentry::check())
{{ Basset::show('form.js') }}
@endif
@stop
