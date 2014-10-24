@extends(Config::get('views.default', 'layouts.default'))

@section('title')
Create Page
@stop

@section('top')
<div class="page-header">
<h1>Create Page</h1>
</div>
@stop

@section('content')
<div class="well">
    <?php
    $form = array('url' => URL::route('pages.store'),
        'method' => 'POST',
        'button' => 'Create New Page',
        'defaults' => array(
            'title' => '',
            'nav_title' => '',
            'slug' => '',
            'icon' => '',
            'body' => '',
            'css' => '',
            'js' => '',
            'show_title' => true,
            'show_nav' => true,
    ), );
    ?>
    @include('pages.form')
</div>
@stop

@section('css')
{{ HTML::style('//cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.0.2/css/bootstrap3/bootstrap-switch.min.css') }}
{{ HTML::style('//cdnjs.cloudflare.com/ajax/libs/bootstrap-markdown/2.7.0/css/bootstrap-markdown.min.css') }}
@stop

@section('js')
{{ HTML::script('//cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.0.2/js/bootstrap-switch.min.js') }}
{{ HTML::script('//cdnjs.cloudflare.com/ajax/libs/bootstrap-markdown/2.7.0/js/bootstrap-markdown.min.js') }}
<script type="text/javascript">
$(document).ready(function () {
    var title = $('#title');
    title.keyup(function (e) {
        val = title.val();
        $("#nav_title").val(val);
        var slug = val.replace(/[^a-zA-Z0-9\s]/g, '')
                 .replace(/^\s+|\s+$/, '')
                 .replace(/\s+/g, '-')
                 .toLowerCase();
        $("#slug").val(slug);
    });
});
</script>
@stop
