@extends(Config::get('views.default', 'layouts.default'))

@section('title')
{{{ $event->getTitle() }}}
@stop

@section('top')
<div class="page-header">
<h1>{{{ $event->getTitle() }}}</h1>
</div>
@stop

@section('content')
@if (Sentry::check() && Sentry::getUser()->hasAccess('edit'))
    <div class="well clearfix">
        <div class="hidden-xs">
            <div class="col-xs-6">
                <p>
                    <strong>Event Creator:</strong> {{ $event->getUserEmail() }}
                </p>
                <a class="btn btn-info" href="{{ URL::route('events.edit', array('events' => $event->getId())) }}"><i class="fa fa-pencil-square-o"></i> Edit Event</a> <a class="btn btn-danger" href="#delete_event" data-toggle="modal" data-target="#delete_event"><i class="fa fa-times"></i> Delete Event</a>
            </div>
            <div class="col-xs-6">
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
<div class="well clearfix">
    <div class="hidden-xs">
        <div class="col-xs-6">
            <p class="lead">Date: {{ $event->getDateByFormat('l jS F Y H:i') }}</p>
        </div>
        <div class="col-xs-6">
            <div class="pull-right">
                <p class="lead">Location: {{ $event->getLocation() }}</p>
            </div>
        </div>
    </div>
    <div class="visible-xs">
        <div class="col-xs-12">
            <p class="lead">Date: {{ $event->getDateByFormat('l jS F Y H:i') }}</p>
            <p class="lead">Location: {{ $event->getLocation() }}</p>
        </div>
    </div>
    <div class="col-xs-12">
        <hr>
        {{ str_replace('<p>', '<p class="lead">', Markdown::render($event->getBody())) }}
    </div>
</div>
@stop

@section('bottom')
@if (Sentry::check() && Sentry::getUser()->hasAccess('edit'))
@include('events.delete')
@endif
@stop

@section('css')
@if (Sentry::check() && Sentry::getUser()->hasAccess('mod'))
{{ Asset::styles('form') }}
@endif
@stop

@section('js')
@if (Sentry::check() && Sentry::getUser()->hasAccess('mod'))
{{ Asset::scripts('form') }}
@endif
@stop
