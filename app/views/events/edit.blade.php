@extends(Config::get('views.default', 'layouts.default'))

@section('title')
Edit {{ $event->getTitle() }}
@stop

@section('controls')
<div class="row">
    <div class="col-xs-6">
        <p class="lead">
            Please edit the event:
        </p>
    </div>
    <div class="col-xs-6">
        <div class="pull-right">
            <a class="btn btn-success" href="{{ URL::route('events.show', array('events' => $event->getId())) }}"><i class="fa fa-file-text"></i> Show Event</a> <a class="btn btn-danger" href="#delete_event" data-toggle="modal" data-target="#delete_event"><i class="fa fa-times"></i> Delete Event</a>
        </div>
        </div>
</div>
<hr>
@stop

@section('content')
<div class="well">
    <?php
    $form = array('url' => URL::route('events.update', array('events' => $event->getId())),
        'method'   => 'PATCH',
        'button'   => 'Save Event',
        'defaults' => array(
            'title'    => $event->getTitle(),
            'date'     => $event->getDate(),
            'location' => $event->getLocation(),
            'body'     => $event->getBody(),
    ));
    ?>
    @include('events.form')
</div>
@stop

@section('messages')
@if (Sentry::check() && Sentry::getUser()->hasAccess('edit'))
@include('events.delete')
@endif
@stop

@section('css')
{{ Basset::show('form.css') }}
@stop

@section('js')
{{ Basset::show('form.js') }}
@stop
