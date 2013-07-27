@extends('layouts.default')

@section('title')
@parent
Edit {{ $page->title }}
@stop

@section('content')

<div class="well">
    <?php
    $form = array('url' => URL::route('pages.update', array('pages' => $page->slug)),
        'method' => 'PUT',
        'button' => 'Save Page',
        'defaults' => array(
            'title' => $page->title,
            'icon' => $page->icon,
            'body' => $page->body,
            'show_title' => ($page->show_title == true),
            'show_nav' => ($page->show_nav == true),
            ));
    ?>
    @include('pages.form')
</div>

@stop
