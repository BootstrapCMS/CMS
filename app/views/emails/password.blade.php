@extends('layouts.email')

@section('content')
<p>Here is your new password:</p>
<p><blockquote>{{ $password }}</blockquote></p>
@stop
