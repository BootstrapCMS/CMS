@extends(Config::get('views.default', 'layouts.default'))

@section('title')
@navtype('admin')
{{{ Lang::get('caching.title') }}}
@stop

@section('top')
<div class="page-header">
<h1>{{{ Lang::get('caching.title') }}}</h1>
</div>
@stop

@section('content')
<p class="lead">{{{ Lang::get('caching.lead') }}}</p>
<hr>
@stop
