@extends(Config::get('views.default', 'layouts.default'))

@section('title')
Edit {{{ $event->title }}}
@stop

@section('top')
<div class="page-header">
<h1>Edit {{{ $event->title }}}</h1>
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
            <a class="btn btn-success" href="{{ URL::route('events.show', array('events' => $event->id)) }}"><i class="fa fa-file-text"></i> Show Event</a> <a class="btn btn-danger" href="#delete_event" data-toggle="modal" data-target="#delete_event"><i class="fa fa-times"></i> Delete Event</a>
        </div>
        </div>
</div>
<hr>
<div class="well">
    <?php
    $form = array('url' => URL::route('events.update', array('events' => $event->id)),
        'method'   => 'PATCH',
        'button'   => 'Save Event',
        'defaults' => array(
            'title'    => $event->title,
            'date'     => $event->date->format('d/m/Y H:i'),
            'location' => $event->location,
            'body'     => $event->body,
    ), );
    ?>
    @include('events.form')
</div>
@stop

@section('bottom')
@auth('edit')
@include('events.delete')
@endauth
@stop

@section('css')
{{ Asset::styles('form') }}
{{ Asset::styles('picker') }}
@stop

@section('js')
{{ Asset::scripts('form') }}
{{ HTML::script('//cdnjs.cloudflare.com/ajax/libs/moment.js/2.6.0/moment.min.js') }}
{{ Asset::scripts('picker') }}
@stop
