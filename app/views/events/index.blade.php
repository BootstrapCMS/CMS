@extends('layouts.default')

@section('title')
Events
@stop

@section('controls')
<div class="row-fluid">
    <div class="span12">
        <div class="span6">
            <p class="lead">
                @if (count($events) == 0)
                    There are currently no events.
                @else
                    Here you may find our events:
                @endif
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
</div>
@stop

@section('content')
@foreach($events as $event)
    <h2>{{ $event->getTitle() }}</h2>
    <p>
        <strong>{{ $event->getFormattedDate() }}</strong>
    </p>
    <p>
        <a class="btn btn-success" href="{{ URL::route('events.show', array('events' => $event->getId())) }}"><i class="icon-file-text"></i> Show Event</a>
        @if (Sentry::check() && Sentry::getUser()->hasAccess('edit'))
             <a class="btn btn-info" href="{{ URL::route('events.edit', array('events' => $event->getId())) }}"><i class="icon-edit"></i> Edit Event</a> <a class="btn btn-danger" href="#delete_event_{{ $event->getId() }}" data-toggle="modal" data-target="#delete_event_{{ $event->getId() }}"><i class="icon-remove"></i> Delete Event</a>
        @endif
    </p>
    <br>
@endforeach
{{ $links }}
@stop

@section('messages')
@if (Sentry::check() && Sentry::getUser()->hasAccess('edit'))
    @include('events.deletes')
@endif
@stop
