@extends('layouts.default')

@section('title')
{{ $event->getTitle() }}
@stop

@section('controls')
@if (Sentry::check() && Sentry::getUser()->hasAccess('edit'))
    <div class="well clearfix">
        <div class="span6">
            <p>
                <strong>Event Creator:</strong> {{ $event->getUserEmail() }}
            </p>
            <a class="btn btn-info" href="{{ URL::route('events.edit', array('events' => $event->getId())) }}"><i class="icon-edit"></i> Edit Event</a> <a class="btn btn-danger" href="#delete_event" data-toggle="modal" data-target="#delete_event"><i class="icon-remove"></i> Delete Event</a>
        </div>
        <div class="span5">
            <div class="pull-right">
                <p>
                    <em>Event Created: {{ $event->getCreatedAt()->diffForHumans() }}</em>
                </p>
                <p>
                    <em>Last Updated: {{ $event->getUpdatedAt()->diffForHumans() }}</em>
                </p>
            </div>
        </div>
    </div>
    <hr>
@endif
@stop

@section('content')
<div class="well clearfix">
    <div class="span6">
        <p class="lead">
            Date: {{ $event->getFormattedDate() }}
        </p>
    </div>
    <div class="span5">
        <div class="pull-right">
            <p class="lead">
                Location: {{ $event->getLocation() }}
            </p>
        </div>
    </div>
    <div class="span11">
        <hr>
        <p class="lead">
            {{ $event->getBody() }}
        </p>
    </div>
</div>
@stop

@section('messages')
@if (Sentry::check() && Sentry::getUser()->hasAccess('edit'))
    @include('events.delete')
@endif
@stop
