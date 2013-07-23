@if (count($errors->all()) > 0)
<div class="alert alert-error">
    <a class="close" data-dismiss="alert">×</a>
    Please check the form below for errors
</div>
@endif

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <a class="close" data-dismiss="alert">×</a>
    {{ $message }}
</div>
@endif

@if ($message = Session::get('error'))
<div class="alert alert-error">
    <a class="close" data-dismiss="alert">×</a>
    {{ $message }}
</div>
@endif

@if ($message = Session::get('warning'))
<div class="alert alert-warning">
    <a class="close" data-dismiss="alert">×</a>
    {{ $message }}
</div>
@endif

@if ($message = Session::get('info'))
<div class="alert alert-info">
    <a class="close" data-dismiss="alert">×</a>
    {{ $message }}
</div>
@endif
