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
@if (Credentials::check() && Credentials::hasAccess('edit'))
    <div class="well clearfix">
        <div class="hidden-xs">
            <div class="col-xs-6">
                <p>
                    <strong>Page Creator:</strong> {{ $page->user()->cacheDriver('array')->rememberForever()->first(array('email'))->email }}
                </p>
                <a class="btn btn-info" href="{{ URL::route('pages.edit', array('pages' => $page->slug)) }}"><i class="fa fa-pencil-square-o"></i> Edit Page</a> <a class="btn btn-danger" href="#delete_page" data-toggle="modal" data-target="#delete_page"><i class="fa fa-times"></i> Delete Page</a>
            </div>
            <div class="col-xs-6">
                <div class="pull-right">
                    <p>
                        <em>Page Created: {{ HTML::ago($page->created_at) }}</em>
                    </p>
                    <p>
                        <em>Last Updated: {{ HTML::ago($page->updated_at) }}</em>
                    </p>
                </div>
            </div>
        </div>
        <div class="visible-xs">
            <div class="col-xs-12">
                <p>
                    <strong>Page Creator:</strong> {{ $page->user()->cacheDriver('array')->rememberForever()->first(array('email'))->email }}
                </p>
                <p>
                    <strong>Page Created:</strong> {{ HTML::ago($page->created_at) }}
                </p>
                <p>
                    <strong>Last Updated:</strong> {{ HTML::ago($page->updated_at) }}
                </p>
                <a class="btn btn-info" href="{{ URL::route('pages.edit', array('pages' => $page->slug)) }}"><i class="fa fa-pencil-square-o"></i> Edit Page</a> <a class="btn btn-danger" href="#delete_page" data-toggle="modal" data-target="#delete_page"><i class="fa fa-times"></i> Delete Page</a>
            </div>
        </div>
    </div>
    <hr>
@endif
@if (Config::get('cms.eval', false))
<?php eval('?>'.$page->body); ?>
@else
{{ $page->body }}
@endif
@stop

@section('bottom')
@if (Credentials::check() && Credentials::hasAccess('edit'))
    @include('pages.delete')
@endif
@stop

@section('css')
{{ $page->css }}
@stop

@section('js')
{{ $page->js }}
@stop
