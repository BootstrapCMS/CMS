@extends(Config::get('views.default', 'layouts.default'))

@section('title')
CloudFlare
@stop

@section('controls')
<p class="lead">Here are your visitor statistics from CloudFlare:</p>
<hr>
@stop

@section('content')
<div id="data">
    <p class="lead"><i class="fa fa-refresh fa-spin fa-lg"></i> Loading...</p>
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
