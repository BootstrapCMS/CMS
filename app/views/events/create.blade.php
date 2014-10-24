@extends(Config::get('views.default', 'layouts.default'))

@section('title')
Create Event
@stop

@section('top')
<div class="page-header">
<h1>Create Event</h1>
</div>
@stop

@section('content')
<div class="well">
    <?php
    $form = array('url' => URL::route('events.store'),
        'method'   => 'POST',
        'button'   => 'Create New Event',
        'defaults' => array(
            'title'    => '',
            'date'     => Carbon\Carbon::now()->addMinutes(30)->format('d/m/Y H:i'),
            'location' => '',
            'body'     => '',
    ), );
    ?>
    @include('events.form')
</div>
@stop

@section('css')
{{ HTML::style('//cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/1.9/css/bootstrap3/bootstrap-switch.css') }}
{{ HTML::style('//cdnjs.cloudflare.com/ajax/libs/bootstrap-markdown/2.7.0/css/bootstrap-markdown.min.css') }}
{{ HTML::style('//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/2.1.30/css/bootstrap-datetimepicker.min.css') }}
@stop

@section('js')
{{ HTML::script('//cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/1.9/js/bootstrap-switch.js') }}
{{ HTML::script('//cdnjs.cloudflare.com/ajax/libs/markdown.js/0.6.0-beta1/markdown.min.js') }}
{{ Asset::scripts('markdown') }}
{{ HTML::script('//cdnjs.cloudflare.com/ajax/libs/bootstrap-markdown/2.7.0/js/bootstrap-markdown.min.js') }}
{{ HTML::script('//cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.3/moment.min.js') }}
{{ HTML::script('//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/2.1.30/js/bootstrap-datetimepicker.min.js') }}
{{ Asset::scripts('picker') }}
@stop
