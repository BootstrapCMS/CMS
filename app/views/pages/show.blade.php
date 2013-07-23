@extends('layouts.default')

@section('title')
@parent
{{ $page->title }}
@stop

@section('content')

<?php eval('?>'.$page->body.'<?'); ?>

@stop
