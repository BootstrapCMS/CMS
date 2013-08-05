<!DOCTYPE html>
<html lang="en-GB">
<head>
    <meta charset="utf-8">
    <title>
        {{ Config::get('cms.name') }} - @section('title')
        @show
    </title>
    {{ HTMLMin::render($__env->make('partials.header', array_except(get_defined_vars(), array('__data', '__path')))->render()) }}
</head>
<body>
    {{ HTMLMin::render($__env->make('partials.navigation', array_except(get_defined_vars(), array('__data', '__path')))->render()) }}
    <div class="container">
        {{ HTMLMin::render($__env->make('partials.title', array_except(get_defined_vars(), array('__data', '__path')))->render()) }}
        {{ HTMLMin::render($__env->make('partials.notifications', array_except(get_defined_vars(), array('__data', '__path')))->render()) }}
        @section('controls')
        {{ HTMLMin::render($__env->yieldSection()) }}
        @section('content')
        @show
        @section('comments')
        {{ HTMLMin::render($__env->yieldSection()) }}
        @section('messages')
        {{ HTMLMin::render($__env->yieldSection()) }}
        <br><hr>
    </div>
    {{ HTMLMin::render($__env->make('partials.footer', array_except(get_defined_vars(), array('__data', '__path')))->render()) }}
</body>
</html>
