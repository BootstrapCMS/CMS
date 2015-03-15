@extends(Config::get('core.default'))

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
    $form = ['url' => URL::route('blog.posts.store'),
        'method' => 'POST',
        'button' => 'Create New Post',
        'defaults' => [
            'title' => '',
            'summary' => '',
            'body' => '',
    ], ];
    ?>
    @include('posts.form')
</div>
@stop

@section('css')
{!! HTML::style('//cdnjs.cloudflare.com/ajax/libs/bootstrap-markdown/2.8.0/css/bootstrap-markdown.min.css') !!}
@stop

@section('js')
{!! HTML::script('//cdnjs.cloudflare.com/ajax/libs/bootstrap-markdown/2.8.0/js/bootstrap-markdown.min.js') !!}
@stop
