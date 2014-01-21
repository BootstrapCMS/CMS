@extends(Config::get('views.default', 'layouts.default'))

@section('title')
{{{ $page->title }}}
@stop

@section('top')
@if($page->show_title)
    <div class="page-header">
    <h1>{{{ $page->title }}}</h1>
    </div>
@endif
@stop

@section('content')
@if (Sentry::check() && Sentry::getUser()->hasAccess('edit'))
    <div class="well clearfix">
        <div class="hidden-xs">
            <div class="col-xs-6">
                <p>
                    <strong>Page Creator:</strong> {{ $page->getUserEmail() }}
                </p>
                <a class="btn btn-info" href="{{ URL::route('pages.edit', array('pages' => $page->slug)) }}"><i class="fa fa-pencil-square-o"></i> Edit Page</a> <a class="btn btn-danger" href="#delete_page" data-toggle="modal" data-target="#delete_page"><i class="fa fa-times"></i> Delete Page</a>
            </div>
            <div class="col-xs-6">
                <div class="pull-right">
                    <p>
                        <em>Page Created: <abbr class="timeago" title="{{ $page->created_at->toISO8601String() }}">{{ $page->created_at->toDateTimeString() }}</abbr></em>
                    </p>
                    <p>
                        <em>Last Updated: <abbr class="timeago" title="{{ $page->updated_at->toISO8601String() }}">{{ $page->updated_at->toDateTimeString() }}</abbr></em>
                    </p>
                </div>
            </div>
        </div>
        <div class="visible-xs">
            <div class="col-xs-12">
                <p>
                    <strong>Page Creator:</strong> {{ $page->getUserEmail() }}
                </p>
                <p>
                    <strong>Page Created:</strong> <abbr class="timeago" title="{{ $page->created_at->toISO8601String() }}">{{ $page->created_at->toDateTimeString() }}</abbr>
                </p>
                <p>
                    <strong>Last Updated:</strong> <abbr class="timeago" title="{{ $page->updated_at->toISO8601String() }}">{{ $page->updated_at->toDateTimeString() }}</abbr>
                </p>
                <a class="btn btn-info" href="{{ URL::route('pages.edit', array('pages' => $page->slug)) }}"><i class="fa fa-pencil-square-o"></i> Edit Page</a> <a class="btn btn-danger" href="#delete_page" data-toggle="modal" data-target="#delete_page"><i class="fa fa-times"></i> Delete Page</a>
            </div>
        </div>
    </div>
    <hr>
@endif
<?php eval('?>'.$page->body); ?>
@stop

@section('bottom')
@if (Sentry::check() && Sentry::getUser()->hasAccess('edit'))
    @include('pages.delete')
@endif
@stop

@section('css')
{{ $page->css }}
@stop

@section('js')
{{ $page->js }}
@stop
