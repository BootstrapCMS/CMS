@extends('layouts.default')

@section('title')
@parent
{{ $post->getTitle() }}
@stop

@section('controls')

@if (Sentry::check() && Sentry::getUser()->hasAccess('blog'))
    <div class="well clearfix">
        <div class="span6">
            <p>
                <strong>Post Creator:</strong> {{ $post->getUserEmail() }}
            </p>
            <a class="btn btn-info" href="{{ URL::route('blog.posts.edit', array('posts' => $post->getId())) }}"><i class="icon-edit"></i> Edit Post</a> <a class="btn btn-danger action_confirm" href="{{ URL::route('blog.posts.destroy', array('posts' => $post->getId())) }}" data-token="{{ Session::getToken() }}" data-method="DELETE"><i class="icon-remove"></i> Delete Post</a>
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

@stop

@section('content')

<?php eval('?>'.Markdown::string($post->getBody())); ?>

@stop

@section('comments')

<hr>
<p class="lead">Comments go here!</p>

@stop
