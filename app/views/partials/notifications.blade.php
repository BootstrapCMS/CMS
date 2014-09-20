@if (count($errors->all()) > 0)
<div class="alert alert-danger cms-alert">
    <a class="close" data-dismiss="alert">×</a>
    Please check the form below for errors
</div>
@endif

<?php $message_types = array('success', 'error', 'warning', 'info'); ?>

@foreach ($message_types as $type)
    @if ($message = Session::get($type))
    <div class="alert alert-{{ $type }} cms-alert">
        <a class="close" data-dismiss="alert">×</a>
        {{ $message }}
    </div>
    @endif
@endforeach
