@extends('layouts.default')

@section('title')
Login
@stop

@section('content')

<p class="lead">Please enter your details:</p>
<div class="well">
    <form class="form-horizontal" action="{{ URL::route('account.login.post') }}" method="post">   
        {{ Form::token(); }}

        <div class="control-group {{ ($errors->has('email')) ? 'error' : '' }}" for="email">
            <label class="control-label" for="email">Email</label>
            <div class="controls">
                <input name="email" id="email" value="{{ Request::old('email') }}" type="text" class="input-xlarge" placeholder="Email">
                {{ ($errors->has('email') ? $errors->first('email') : '') }}
            </div>
        </div>
    
       <div class="control-group {{ ($errors->has('password')) ? 'error' : '' }}" for="password">
            <label class="control-label" for="password">Password</label>
            <div class="controls">
                <input name="password" id="password" value="" type="password" class="input-xlarge" placeholder="Password">
                {{ ($errors->has('password') ?  $errors->first('password') : '') }}
            </div>
        </div>

        <div class="control-group" for="rememberme">
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
  </form>
</div>

@stop
