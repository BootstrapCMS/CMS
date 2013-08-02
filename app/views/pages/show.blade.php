@extends('layouts.default')

@section('title')
@parent
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
                <strong>Page Creator:</strong> {{ $page->getUser()->email }}
            </p>
            <a class="btn btn-info" href="{{ URL::route('pages.edit', array('pages' => $page->getSlug())) }}">Edit Page</a> <a class="btn btn-danger action_confirm" href="{{ URL::route('pages.destroy', array('pages' => $page->getSlug())) }}" data-token="{{ Session::getToken() }}" data-method="DELETE">Delete Page</a>
        </div>
        <div class="span5">
            <div class="pull-right">
                <p>
                    <em>Page Created: {{ $page->getCreatedAt() }}</em>
                </p>
                <p>
                    <em>Last Updated: {{ $page->getUpdatedAt() }}</em>
                </p>
            </div>
        </div>
    </div>
    <hr>
@endif

@stop

@section('content')

<?php eval('?>'.Markdown::string($page->getBody())); ?>

@stop
