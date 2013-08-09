@extends('layouts.default')

@section('title')
Register
@stop

@section('controls')
<p class="lead">Please enter your details:</p>
@stop

@section('content')
<div class="well">
    {{ Form::open(array('url' => URL::route('account.register.post'), 'method' => 'POST', 'class' => 'form-horizontal')) }}

        <div class="control-group{{ ($errors->has('first_name')) ? ' error' : '' }}">
            <label class="control-label" for="first_name">First Name</label>
            <div class="controls">
                <input name="first_name" id="first_name" value="{{ Request::old('first_name') }}" type="text" class="input-xlarge" placeholder="First Name">
                {{ ($errors->has('first_name') ? $errors->first('first_name') : '') }}
            </div>
        </div>

        <div class="control-group{{ ($errors->has('last_name')) ? ' error' : '' }}">
            <label class="control-label" for="last_name">Last Name</label>
            <div class="controls">
                <input name="last_name" id="last_name" value="{{ Request::old('last_name') }}" type="text" class="input-xlarge" placeholder="Last Name">
                {{ ($errors->has('last_name') ? $errors->first('last_name') : '') }}
            </div>
        </div>  

        <div class="control-group{{ ($errors->has('email')) ? ' error' : '' }}">
            <label class="control-label" for="email">Email</label>
            <div class="controls">
                <input name="email" id="email" value="{{ Request::old('email') }}" type="text" class="input-xlarge" placeholder="Email">
                {{ ($errors->has('email') ? $errors->first('email') : '') }}
            </div>
        </div>  

        <div class="control-group{{ $errors->has('password') ? ' error' : '' }}">
            <label class="control-label" for="password">Password</label>
            <div class="controls">
                <input name="password" id="password" value="" type="password" class="input-xlarge" placeholder="Password">
                {{ ($errors->has('password') ?  $errors->first('password') : '') }}
            </div>
        </div>

        <div class="control-group{{ $errors->has('password_confirmation') ? ' error' : '' }}">
            <label class="control-label" for="password_confirmation">Confirm Password</label>
            <div class="controls">
                <input name="password_confirmation" id="password_confirmation" value="" type="password" class="input-xlarge" placeholder="Confirm Password">
                {{ ($errors->has('password_confirmation') ? $errors->first('password_confirmation') : '') }}
            </div>
        </div>

        <div class="form-actions">
            <button class="btn btn-primary" type="submit"><i class="icon-rocket"></i> Register</button>
            <button class="btn btn-inverse" type="reset">Reset</button>
        </div>  
    {{ Form::close() }}
</div>
@stop
