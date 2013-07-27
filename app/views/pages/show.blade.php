@extends('layouts.default')

@section('title')
@parent
{{ $page->title }}
@stop

@section('controls')

@if (Sentry::check() && Sentry::getUser()->hasAccess('edit'))
    <div class="well clearfix">
        <div class="span6">
            <p>
                <strong>Page Creator:</strong> {{ $page->user()->first()->email }}
            </p>
            <a class="btn btn-info" href="{{ URL::route('pages.edit', array('pages' => $page->slug)) }}">Edit Page</a>
        </div>
        <div class="span5">
            <div class="pull-right">
                <p>
                    <em>Page Created: {{ $page->created_at }}</em>
                </p>
                <p>
                    <em>Last Updated: {{ $page->updated_at }}</em>
                </p>
            </div>
        </div>
    </div>
    <hr>
@endif

@stop

@section('content')

<?php eval('?>'.Markdown::string($page->body)); ?>

@stop
