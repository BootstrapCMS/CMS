@extends(Config::get('views.default', 'layouts.default'))

@section('title')
Events
@stop

@section('top')
<div class="page-header">
<h1>Events</h1>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-xs-8">
        <p class="lead">
            @if (count($events) == 0)
                There are currently no events.
            @else
                Here you may find our events:
            @endif
        </p>
    </div>
    @if (Sentry::check() && Sentry::getUser()->hasAccess('edit'))
        <div class="col-xs-4">
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ URL::route('events.create') }}"><i class="fa fa-calendar"></i> New Event</a>
            </div>
        </div>
    @endif
</div>
@foreach($events as $event)
    <h2>{{ $event->getTitle() }}</h2>
    <p>
        <strong>{{ $event->getDateByFormat('l jS F Y H:i') }}</strong>
    </p>
    <p>
        <a class="btn btn-success" href="{{ URL::route('events.show', array('events' => $event->getId())) }}"><i class="fa fa-file-text"></i> Show Event</a>
        @if (Sentry::check() && Sentry::getUser()->hasAccess('edit'))
             <a class="btn btn-info" href="{{ URL::route('events.edit', array('events' => $event->getId())) }}"><i class="fa fa-pencil-square-o"></i> Edit Event</a> <a class="btn btn-danger" href="#delete_event_{{ $event->getId() }}" data-toggle="modal" data-target="#delete_event_{{ $event->getId() }}"><i class="fa fa-times"></i> Delete Event</a>
        @endif
    </p>
    <br>
@endforeach
{{ $links }}
@stop

@section('bottom')
@if (Sentry::check() && Sentry::getUser()->hasAccess('edit'))
    @include('events.deletes')
@endif
@stop
