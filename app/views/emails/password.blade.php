@extends('layouts.email')

@section('content')
<p>Here is your temporary password:</p>
<p><blockquote>{{ $password }}</blockquote></p>
<p>You should change it to something more memorable on the account page after you login.</p>
@stop
