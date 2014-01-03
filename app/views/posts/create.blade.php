@extends(Config::get('views.default', 'layouts.default'))

@section('title')
Create Post
@stop

@section('top')
<div class="page-header">
<h1>Create Post</h1>
</div>
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

@section('css')
{{ Asset::styles('form') }}
@stop

@section('js')
{{ Asset::scripts('form') }}
@stop
