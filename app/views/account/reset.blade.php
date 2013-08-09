@extends('layouts.default')

@section('title')
Reset Password
@stop

@section('controls')
<p class="lead">Please enter your details:</p>
@stop

@section('content')
<div class="well">
    {{ Form::open(array('url' => URL::route('account.reset.post'), 'method' => 'POST', 'class' => 'form-horizontal')) }}

        <div class="control-group{{ ($errors->has('email')) ? ' error' : '' }}">
            <label class="control-label" for="email">Email Address</label>
            <div class="controls">
                <input name="email" id="email" value="{{ Request::old('email') }}" type="text" class="input-xlarge" placeholder="Email Address">
                {{ ($errors->has('email') ? $errors->first('email') : '') }}
            </div>
        </div>

        <div class="form-actions">
            <button class="btn btn-primary" type="submit"><i class="icon-rocket"></i> Reset Password</button>
        </div>
    {{ Form::close() }}
</div>
@stop
