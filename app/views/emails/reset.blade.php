@extends('layouts.email')

@section('content')
<p>To reset your password, <a href="{{ $link }}">click here.</a></p>
<p>After confirming this request, you will receive an email with your temporary password.</p>
@stop
