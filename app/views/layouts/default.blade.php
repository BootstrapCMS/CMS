<!DOCTYPE html>
<html lang="{{{ Config::get('app.locale') }}}">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>{{{ Config::get('platform.name') }}} - @section('title')
@show</title>
@include(Config::get('views.header', 'partials.header'))
</head>
<body>
<div id="wrap">
@navigation
<div class="container">
@section('top')
@show
@include(Config::get('views.notifications', 'partials.notifications'))
@section('content')
@show
@include(Config::get('views.footer', 'partials.footer'))
@section('bottom')
@show
</body>
</html>
