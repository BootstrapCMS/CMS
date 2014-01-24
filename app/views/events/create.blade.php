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
    ));
    ?>
    @include('events.form')
</div>
@stop

@section('css')
{{ Asset::styles('form') }}
{{ Asset::styles('picker') }}
@stop

@section('js')
{{ Asset::scripts('form') }}
{{ HTML::script('//cdnjs.cloudflare.com/ajax/libs/moment.js/2.5.1/moment.min.js') }}
{{ Asset::scripts('picker') }}
@stop
