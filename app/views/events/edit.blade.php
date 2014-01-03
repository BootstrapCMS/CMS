@extends(Config::get('views.default', 'layouts.default'))

@section('title')
Edit {{{ $event->getTitle() }}}
@stop

@section('top')
<div class="page-header">
<h1>Edit {{{ $event->getTitle() }}}</h1>
</div>
@stop

@section('content')
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
<div class="well">
    <?php
    $form = array('url' => URL::route('events.update', array('events' => $event->getId())),
        'method'   => 'PATCH',
        'button'   => 'Save Event',
        'defaults' => array(
            'title'    => $event->getTitle(),
            'date'     => $event->getDateByFormat('d/m/Y H:i'),
            'location' => $event->getLocation(),
            'body'     => $event->getBody(),
    ));
    ?>
    @include('events.form')
</div>
@stop

@section('bottom')
@if (Sentry::check() && Sentry::getUser()->hasAccess('edit'))
@include('events.delete')
@endif
@stop

@section('css')
{{ Asset::styles('form') }}
{{ Asset::styles('picker') }}
@stop

@section('js')
{{ Asset::scripts('form') }}
{{ Asset::scripts('picker') }}
@stop
