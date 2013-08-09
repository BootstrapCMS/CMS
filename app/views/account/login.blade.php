@extends('layouts.default')

@section('title')
Login
@stop

@section('controls')
<p class="lead">Please enter your details:</p>
@stop

@section('content')
<div class="well">
    {{ Form::open(array('url' => URL::route('account.login.post'), 'method' => 'POST', 'class' => 'form-horizontal')) }}

        <div class="control-group{{ ($errors->has('email')) ? ' error' : '' }}">
            <label class="control-label" for="email">Email</label>
            <div class="controls">
                <input name="email" id="email" value="{{ Request::old('email') }}" type="text" class="input-xlarge" placeholder="Email">
                {{ ($errors->has('email') ? $errors->first('email') : '') }}
            </div>
        </div>
    
       <div class="control-group{{ ($errors->has('password')) ? ' error' : '' }}">
            <label class="control-label" for="password">Password</label>
            <div class="controls">
                <input name="password" id="password" value="" type="password" class="input-xlarge" placeholder="Password">
                {{ ($errors->has('password') ?  $errors->first('password') : '') }}
            </div>
        </div>

        <div class="control-group">
            <div class="controls">
                <label class="checkbox inline">
                    <input type="checkbox" name="rememberMe" value="1"> Remember Me
                </label>
            </div>
        </div>
    
        <div class="form-actions">
            <button class="btn btn-primary" type="submit"><i class="icon-rocket"></i> Log In</button>
            <a href="{{ URL::route('account.reset') }}" class="btn btn-link">Forgot Password?</a>
        </div>
  {{ Form::close() }}
</div>
@stop
