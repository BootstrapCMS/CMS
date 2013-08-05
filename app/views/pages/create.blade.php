@extends('layouts.default')

@section('title')
@parent
Create Page
@stop

@section('content')

<div class="well">
    <?php
    $form = array('url' => URL::route('pages.store'),
        'method' => 'POST',
        'button' => 'Create New Page',
        'defaults' => array(
            'title' => '',
            'icon' => '',
            'body' => '',
            'show_title' => true,
            'show_nav' => true,
    ));
    ?>
    @include('pages.form')
</div>

@stop

@section('css')

{{ Basset::show('switches.css') }}

@stop

@section('js')

{{ Basset::show('switches.js') }}

@stop
