@extends('layouts.default')

@section('title')
Edit {{ $page->getTitle() }}
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
                <a class="btn btn-success" href="{{ URL::route('pages.show', array('pages' => $page->getSlug())) }}"><i class="icon-file-text"></i> Show Page</a> <a class="btn btn-danger" href="#delete_page" data-toggle="modal" data-target="#delete_page"><i class="icon-remove"></i> Delete Page</a>
            </div>
        </div>
    </div>
</div>
<hr>
@stop

@section('content')
<div class="well">
    <?php
    $form = array('url' => URL::route('pages.update', array('pages' => $page->getSlug())),
        'method' => 'PATCH',
        'button' => 'Save Page',
        'defaults' => array(
            'title' => $page->getTitle(),
            'icon' => $page->getIcon(),
            'body' => $page->getBody(),
            'show_title' => ($page->getShowTitle() == true),
            'show_nav' => ($page->getShowNav() == true),
    ));
    ?>
    @include('pages.form')
</div>
@stop

@section('messages')
@if (Sentry::check() && Sentry::getUser()->hasAccess('edit'))
    @include('pages.delete')
@endif
@stop

@section('css')
{{ Basset::show('switches.css') }}
@stop

@section('js')
{{ Basset::show('switches.js') }}
@stop
