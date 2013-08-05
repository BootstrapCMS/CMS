@extends('layouts.default')

@section('title')
@parent
Register
@stop

@section('content')
<p class="lead">Please enter your details:</p>
<div class="well">
    <form class="form-horizontal" action="{{ URL::route('account.register.post') }}" method="post">
        {{ Form::token() }}
        
        <div class="control-group {{ ($errors->has('email')) ? 'error' : '' }}" for="email">
            <label class="control-label" for="email">Email</label>
            <div class="controls">
                <input name="email" id="email" value="{{ Request::old('email') }}" type="text" class="input-xlarge" placeholder="Email">
                {{ ($errors->has('email') ? $errors->first('email') : '') }}
            </div>
        </div>  

        <div class="control-group {{ $errors->has('password') ? 'error' : '' }}" for="password">
            <label class="control-label" for="password">Password</label>
            <div class="controls">
                <input name="password" id="password" value="" type="password" class="input-xlarge" placeholder="Password">
                {{ ($errors->has('password') ?  $errors->first('password') : '') }}
            </div>
        </div>

        <div class="control-group {{ $errors->has('password_confirmation') ? 'error' : '' }}" for="password_confirmation">
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
    </form>
</div>


@stop