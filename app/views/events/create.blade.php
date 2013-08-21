@extends('layouts.default')

@section('title')
Create Event
@stop

@section('content')
<div class="well">
    <?php
    $form = array('url' => URL::route('events.store'),
        'method'   => 'POST',
        'button'   => 'Create New Event',
        'defaults' => array(
            'title'    => '',
            'date'     => Carbon::now(),
            'location' => '',
            'body'     => '',
    ));
    ?>
    @include('events.form')
</div>
@stop

@section('css')
{{ Basset::show('select.css') }}
{{ Basset::show('markdown.css') }}
@stop

@section('js')
{{ Basset::show('select.js') }}
{{ Basset::show('markdown.js') }}
@stop
