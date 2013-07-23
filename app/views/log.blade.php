@extends('layouts.default')

<?php $name = 'Log'; ?>

@section('title')
@parent
{{ $name }}
@stop

@section('content')

<p class="lead">The log file {{ $file }} reads:</p>

@if (file_exists($path))
    <pre>{{ File::get($path) }}</pre>
@else
    {{ App::abort(404) }}
@endif

@stop
