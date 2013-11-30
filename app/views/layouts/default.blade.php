<!DOCTYPE html>
<html lang="en-GB">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>{{ Config::get('cms.name') }} - @section('title')
@show</title>
@include(Config::get('views.header', 'partials.header'))
</head>
<body>
<div id="wrap">
@include(Config::get('views.navigation', 'partials.navigation'))
<div class="container">
@include(Config::get('views.title', 'partials.title')))
@include(Config::get('views.notifications', 'partials.notifications')))
@section('controls')
@show
@section('content')
@show
@section('comments')
@show
@section('messages')
@show
@include(Config::get('views.footer', 'partials.footer')))
</body>
</html>
