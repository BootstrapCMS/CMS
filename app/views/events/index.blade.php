@extends('layouts.default')

@section('title')
@parent
Events
@stop

@section('controls')

<div class="row-fluid">
    <div class="span12">
        <div class="span6">
            <p class="lead">
                Here you may find our events:
            </p>
        </div>
        @if (Sentry::check() && Sentry::getUser()->hasAccess('edit'))
            <div class="span6">
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ URL::route('events.create') }}"><i class="icon-calendar"></i> New Event</a>
                </div>
            </div>
        @endif
    </div>
<hr>

@stop

@section('content')

@stop
