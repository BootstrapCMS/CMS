@extends('layouts.email')

@section('content')
<p>Thank you for creating an account on <a href="{{ $url }}">{{ Config::get('cms.name') }}</a>.<p>
<p>To activate your account, <a href="{{ $link }}">click here</a>.</p>
@stop
