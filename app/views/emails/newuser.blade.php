@extends('layouts.email')

@section('content')
<p>An admin from <a href="{{ $url }}">{{ Config::get('cms.name') }}</a> has created you an account.<p>
<p>Here is your password:</p>
<p><blockquote>{{ $password }}</blockquote></p>
@stop
