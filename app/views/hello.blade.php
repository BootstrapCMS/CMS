@extends('layouts.default')

<?php $name = 'Hello World'; ?>

@section('title')
{{ ucwords(str_replace('-', ' ', $name)) }}
@stop

@section('content')
<p class="lead">
    @if (Sentry::check())
       You are currently logged in.
    @else
       You are currently not logged in.
    @endif
</p>
@stop
