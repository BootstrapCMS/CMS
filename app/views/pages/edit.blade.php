@extends('layouts.default')

@section('title')
@parent
Edit {{ $page->title }}
@stop

@section('controls')

<div class="row-fluid">
    <div class="span12">
        <div class="span6">
            <p class="lead">
                Please edit the page:
            </p>
        </div>

        <div class="span6">
            <div class="pull-right">
                <a class="btn btn-success" href="{{ URL::route('pages.show', array('pages' => $page->slug)) }}">Show Page</a> <a class="btn btn-danger action_confirm" href="{{ URL::route('pages.destroy', array('pages' => $page->slug)) }}" data-token="{{ Session::getToken() }}" data-method="DELETE">Delete Page</a>
            </div>
        </div>
<hr>

@stop

@section('content')

<div class="well">
    <?php
    $form = array('url' => URL::route('pages.update', array('pages' => $page->slug)),
        'method' => 'PATCH',
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

@section('css')

{{ Basset::show('switches.css') }}
{{ Basset::show('editor.css') }}

@stop

@section('js')

{{ Basset::show('switches.js') }}
{{ Basset::show('editor.js') }}

@stop
