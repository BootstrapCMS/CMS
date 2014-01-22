@extends(Config::get('views.default', 'layouts.default'))

@section('title')
Edit {{{ $post->title }}}
@stop

@section('top')
<div class="page-header">
<h1>Edit {{{ $post->title }}}</h1>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-xs-6">
        <p class="lead">
            Please edit the post:
        </p>
    </div>
    <div class="col-xs-6">
        <div class="pull-right">
            <a class="btn btn-success" href="{{ URL::route('blog.posts.show', array('posts' => $post->id)) }}"><i class="fa fa-file-text"></i> Show Post</a> <a class="btn btn-danger" href="#delete_post" data-toggle="modal" data-target="#delete_post"><i class="fa fa-times"></i> Delete Post</a>
        </div>
    </div>
</div>
<hr>
<div class="well">
    <?php
    $form = array('url' => URL::route('blog.posts.update', array('posts' => $post->id)),
        'method' => 'PATCH',
        'button' => 'Save Post',
        'defaults' => array(
            'title' => $post->title,
            'summary' => $post->summary,
            'body' => $post->body,
    ));
    ?>
    @include('posts.form')
</div>
@stop

@section('bottom')
@if (Credentials::check() && Credentials::hasAccess('blog'))
    @include('posts.delete')
@endif
@stop

@section('css')
{{ Asset::styles('form') }}
@stop

@section('js')
{{ Asset::scripts('form') }}
@stop
