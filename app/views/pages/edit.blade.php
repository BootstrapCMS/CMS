@extends(Config::get('views.default', 'layouts.default'))

@section('title')
Edit {{ $page->getTitle() }}
@stop

@section('controls')
<div class="row">
    <div class="col-xs-6">
        <p class="lead">
            Please edit the page:
        </p>
    </div>
    <div class="col-xs-6">
        <div class="pull-right">
            <a class="btn btn-success" href="{{ URL::route('pages.show', array('pages' => $page->getSlug())) }}"><i class="fa fa-file-text"></i> Show Page</a> <a class="btn btn-danger" href="#delete_page" data-toggle="modal" data-target="#delete_page"><i class="fa fa-times"></i> Delete Page</a>
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
            'css' => $page->getCSS(),
            'js' => $page->getJS(),
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
{{ Asset::styles('form') }}
@stop

@section('js')
{{ Asset::scripts('form') }}
@stop
