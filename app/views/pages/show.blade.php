@extends('layouts.default')

@section('title')
{{ $page->getTitle() }}
<?php 
if($page->getShowTitle() == false) {
    $hide_title = true;
}
?>
@stop

@section('controls')
@if (Sentry::check() && Sentry::getUser()->hasAccess('edit'))
    <div class="well clearfix">
        <div class="span6">
            <p>
                <strong>Page Creator:</strong> {{ $page->getUserEmail() }}
            </p>
            <a class="btn btn-info" href="{{ URL::route('pages.edit', array('pages' => $page->getSlug())) }}"><i class="icon-edit"></i> Edit Page</a> <a class="btn btn-danger" href="#delete_page" data-toggle="modal" data-target="#delete_page"><i class="icon-remove"></i> Delete Page</a>
        </div>
        <div class="span5">
            <div class="pull-right">
                <p>
                    <em>Page Created: {{ $page->getCreatedAt()->diffForHumans() }}</em>
                </p>
                <p>
                    <em>Last Updated: {{ $page->getUpdatedAt()->diffForHumans() }}</em>
                </p>
            </div>
        </div>
    </div>
    <hr>
@endif
@stop

@section('content')
<?php eval('?>'.$page->getBody()); ?>
@stop

@section('messages')
@if (Sentry::check() && Sentry::getUser()->hasAccess('edit'))
    @include('pages.delete')
@endif
@stop
