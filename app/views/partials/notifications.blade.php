@if (count($errors->all()) > 0)
<div class="alert alert-danger cms-alert">
    <a class="close" data-dismiss="alert">×</a>
    Please check the form below for errors
</div>
@endif

@if ($message = Session::get('success'))
<div class="alert alert-success cms-alert">
    <a class="close" data-dismiss="alert">×</a>
    {{ $message }}
</div>
@endif

@if ($message = Session::get('error'))
<div class="alert alert-danger cms-alert">
    <a class="close" data-dismiss="alert">×</a>
    {{ $message }}
</div>
@endif

@if ($message = Session::get('warning'))
<div class="alert alert-warning cms-alert">
    <a class="close" data-dismiss="alert">×</a>
    {{ $message }}
</div>
@endif

@if ($message = Session::get('info'))
<div class="alert alert-info cms-alert">
    <a class="close" data-dismiss="alert">×</a>
    {{ $message }}
</div>
@endif
