@extends('layouts.default')

@section('title')
Edit {{ $post->getTitle() }}
@stop

@section('controls')
<div class="row-fluid">
    <div class="span12">
        <div class="span6">
            <p class="lead">
                Please edit the post:
            </p>
        </div>
        <div class="span6">
            <div class="pull-right">
                <a class="btn btn-success" href="{{ URL::route('blog.posts.show', array('posts' => $post->getId())) }}"><i class="icon-file-text"></i> Show Post</a> <a class="btn btn-danger" href="#delete_post" data-toggle="modal" data-target="#delete_post"><i class="icon-remove"></i> Delete Post</a>
            </div>
        </div>
    </div>
</div>
<hr>
@stop

@section('content')
<div class="well">
    <?php
    $form = array('url' => URL::route('blog.posts.update', array('posts' => $post->getId())),
        'method' => 'PATCH',
        'button' => 'Save Post',
        'defaults' => array(
            'title' => $post->getTitle(),
            'summary' => $post->getSummary(),
            'body' => $post->getBody(),
    ));
    ?>
    @include('posts.form')
</div>
@stop

@section('messages')
@if (Sentry::check() && Sentry::getUser()->hasAccess('blog'))
    @include('posts.delete')
@endif
@stop
