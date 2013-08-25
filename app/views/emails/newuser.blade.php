@extends('layouts.email')

@section('content')
<p>An admin from <a href="{{ $url }}">{{ Config::get('cms.name') }}</a> has created you an account.<p>
<p>Here is your temporary password:</p>
<p><blockquote>{{ $password }}</blockquote></p>
<p>You should change it to something more memorable on the account page after you login.</p>
@stop
