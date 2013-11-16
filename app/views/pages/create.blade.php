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
{{ Basset::show('form.css') }}
@stop

@section('js')
{{ Basset::show('form.js') }}
@stop
