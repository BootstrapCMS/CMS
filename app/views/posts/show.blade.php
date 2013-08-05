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
                    Author: {{ $post->getUserEmail() }}
                </p>
            </div>
        </div>
    </div>
</div>
<br>

@stop

@section('content')

<?php eval('?>'.Markdown::string($post->getBody())); ?>

@stop

@section('comments')

<br>
<hr>
<h4>Comments</h4>
@if (Sentry::check() && Sentry::getUser()->hasAccess('user'))
    <div class="row-fluid">
        <div class="span12">
            <form class="form-vertical" action="{{ URL::route('blog.posts.comments.store', array('posts' => $post->getId())) }}" method="post">   
                {{ Form::token() }}
                <div class="controls controls-row">
                    <div class="controls">
                        <textarea id="message" name="message" class="span12, comment-box" placeholder="Your Message" rows="5"></textarea>
                    </div>
                <div class="controls">
                    <button id="contact-submit" type="submit" class="btn btn-primary"><i class="icon-comment"></i> Comment</button>
                </div>
            </form>
        </div>
    </div>
@else
<p>
    <strong>Please <a href="{{ URL::route('account.login') }}">login</a> or <a href="{{ URL::route('account.register') }}">register</a> to post a comment.</strong>
</p>
<br>
@endif

@if (count($comments) == 0)
<p>There are currently no comments.</p>
@else
    @foreach ($comments as $key => $comment)
        @if ($key != 0)
        <hr>
        @endif
        <p><strong>User</strong> - time</p>
        <p>{{ $comment }}</p>
    @endforeach
@endif

@stop

@section('messages')

@if (Sentry::check() && Sentry::getUser()->hasAccess('blog'))
    @include('posts.delete')
@endif

@stop
