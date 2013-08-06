@extends('layouts.default')

@section('title')
Blog
@stop

@section('controls')
<div class="row-fluid">
    <div class="span12">
        <div class="span6">
            <p class="lead">
                @if (count($posts) == 0)
                    There are currently no blog posts.
                @else
                    Here you may find our blog posts:
                @endif
            </p>
        </div>
        @if (Sentry::check() && Sentry::getUser()->hasAccess('blog'))
            <div class="span6">
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ URL::route('blog.posts.create') }}"><i class="icon-book"></i> New Post</a>
                </div>
            </div>
        @endif
    </div>
</div>
@stop

@section('content')
@foreach($posts as $key => $post)
    <h2>{{ $post->getTitle() }}</h2>
    <p>
        {{ $post->getSummary() }}
    </p>
    <p>
        <a class="btn btn-success" href="{{ URL::route('blog.posts.show', array('posts' => $post->getId())) }}"><i class="icon-file-text"></i> Show Post</a>
        @if (Sentry::check() && Sentry::getUser()->hasAccess('blog'))
             <a class="btn btn-info" href="{{ URL::route('blog.posts.edit', array('posts' => $post->getId())) }}"><i class="icon-edit"></i> Edit Post</a> <a class="btn btn-danger" href="#delete_post_{{ $post->getId() }}" data-toggle="modal" data-target="#delete_post_{{ $post->getId() }}"><i class="icon-remove"></i> Delete Post</a>
        @endif
    </p>
    @if (!$key == count($posts)-1)
    <br>
@endif
@endforeach
@stop

@section('messages')
@if (Sentry::check() && Sentry::getUser()->hasAccess('blog'))
    @include('posts.deletes')
@endif
@stop
