@extends(Config::get('core.default'))

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
    $form = ['url' => URL::route('events.store'),
        'method'   => 'POST',
        'button'   => 'Create New Event',
        'defaults' => [
            'title'    => '',
            'date'     => Carbon\Carbon::now()->addMinutes(30)->format('d/m/Y H:i'),
            'location' => '',
            'body'     => '',
    ], ];
    ?>
    @include('events.form')
</div>
@stop

@section('css')
{!! HTML::style('//cdnjs.cloudflare.com/ajax/libs/bootstrap-markdown/2.8.0/css/bootstrap-markdown.min.css') !!}
{!! HTML::style('//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/css/bootstrap-datetimepicker.min.css') !!}
@stop

@section('js')
{!! HTML::script('//cdnjs.cloudflare.com/ajax/libs/bootstrap-markdown/2.8.0/js/bootstrap-markdown.min.js') !!}
{!! HTML::script('//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js') !!}
{!! HTML::script('//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/js/bootstrap-datetimepicker.min.js') !!}
{!! Asset::scripts('picker') !!}
@stop
