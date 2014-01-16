@extends(Config::get('views.default', 'layouts.default'))

@section('title')
Hello World
@stop

@section('top')
<div class="page-header">
<h1>Hello World</h1>
</div>
@stop

@section('content')
<p class="lead">
    This is the {{{ Config::get('platform.name') }}} test page.
</p>
@stop
