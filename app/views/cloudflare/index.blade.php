@extends('layouts.default')

@section('title')
Cloudflare
@stop

@section('controls')
<p class="lead">Here are your visitor statistics from CloudFlare:</p>
<hr>
@stop

@section('content')
<div id="data">
    <p class="lead"><i class="icon-refresh icon-spin icon-large"></i> Loading...</p>
</div>
@stop

@section('js')
<script>
    $(function(){
        var request = $.get('{{ URL::route('cloudflare.data') }}');
        request.success(function(result) {
            $('#data').addClass('well');
            $('#data').html(result);
        });
        request.error(function(jqXHR, textStatus, errorThrown) {
            $('#data').html('<p class="lead">There was an error getting the data</p>');
        });
    });
</script>
@stop
