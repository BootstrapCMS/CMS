@extends('layouts.default')

@section('title')
{{ $event->getTitle() }}
@stop

@section('controls')
@if (Sentry::check() && Sentry::getUser()->hasAccess('edit'))
    <div class="well clearfix">
        <div class="hidden-xs">
            <div class="col-sm-6">
                <p>
                    <strong>Event Creator:</strong> {{ $event->getUserEmail() }}
                </p>
                <a class="btn btn-info" href="{{ URL::route('events.edit', array('events' => $event->getId())) }}"><i class="fa fa-pencil-square-o"></i> Edit Event</a> <a class="btn btn-danger" href="#delete_event" data-toggle="modal" data-target="#delete_event"><i class="fa fa-times"></i> Delete Event</a>
            </div>
            <div class="col-sm-6">
                <div class="pull-right">
                    <p>
                        <em>Event Created: <abbr class="timeago" title="{{ $event->getCreatedAt()->toISO8601String() }}">{{ $event->getCreatedAt()->toDateTimeString() }}</abbr></em>
                    </p>
                    <p>
                        <em>Last Updated: <abbr class="timeago" title="{{ $event->getUpdatedAt()->toISO8601String() }}">{{ $event->getUpdatedAt()->toDateTimeString() }}</abbr></em>
                    </p>
                </div>
            </div>
        </div>
        <div class="visible-xs">
            <div class="col-xs-12">
                <p>
                    <strong>Event Creator:</strong> {{ $event->getUserEmail() }}
                </p>
                <p>
                    <strong>Event Created:</strong> <abbr class="timeago" title="{{ $event->getCreatedAt()->toISO8601String() }}">{{ $event->getCreatedAt()->toDateTimeString() }}</abbr>
                </p>
                <p>
                    <strong>Last Updated:</strong> <abbr class="timeago" title="{{ $event->getUpdatedAt()->toISO8601String() }}">{{ $event->getUpdatedAt()->toDateTimeString() }}</abbr>
                </p>
                <a class="btn btn-info" href="{{ URL::route('events.edit', array('events' => $event->getId())) }}"><i class="fa fa-pencil-square-o"></i> Edit Event</a> <a class="btn btn-danger" href="#delete_event" data-toggle="modal" data-target="#delete_event"><i class="fa fa-times"></i> Delete Event</a>
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
            {{ Markdown::string($event->getBody()) }}
        </p>
    </div>
</div>
@stop

@section('messages')
@if (Sentry::check() && Sentry::getUser()->hasAccess('edit'))
@include('events.delete')
@endif
@stop


@section('css')
@if (Sentry::check() && Sentry::getUser()->hasAccess('mod'))
{{ Basset::show('form.css') }}
@endif
@stop

@section('js')
@if (Sentry::check() && Sentry::getUser()->hasAccess('mod'))
{{ Basset::show('form.css') }}
@endif
@stop
