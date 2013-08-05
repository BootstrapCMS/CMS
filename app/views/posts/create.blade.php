@extends('layouts.default')

@section('title')
@parent
Create Post
@stop

@section('content')

<div class="well">
    <?php
    $form = array('url' => URL::route('blog.posts.store'),
        'method' => 'POST',
        'button' => 'Create New Post',
        'defaults' => array(
            'title' => '',
            'summary' => '',
            'body' => '',
    ));
    ?>
    @include('posts.form')
</div>

@stop
