@extends(Config::get('views.default', 'layouts.default'))

@section('title')
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
            'css' => '',
            'js' => '',
            'show_title' => true,
            'show_nav' => true,
    ));
    ?>
    @include('pages.form')
</div>
@stop

@section('css')
{{ Asset::styles('form') }}
@stop

@section('js')
{{ Asset::scripts('form') }}
@stop
