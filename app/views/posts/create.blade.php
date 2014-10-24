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
    ), );
    ?>
    @include('posts.form')
</div>
@stop

@section('css')
{{ HTML::style('//cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/1.9/css/bootstrap3/bootstrap-switch.css') }}
{{ HTML::style('//cdnjs.cloudflare.com/ajax/libs/bootstrap-markdown/2.7.0/css/bootstrap-markdown.min.css') }}
@stop

@section('js')
{{ HTML::script('//cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/1.9/js/bootstrap-switch.js') }}
{{ HTML::script('//cdnjs.cloudflare.com/ajax/libs/markdown.js/0.6.0-beta1/markdown.min.js') }}
{{ Asset::scripts('markdown') }}
{{ HTML::script('//cdnjs.cloudflare.com/ajax/libs/bootstrap-markdown/2.7.0/js/bootstrap-markdown.min.js') }}
@stop
