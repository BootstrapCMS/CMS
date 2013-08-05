@extends('layouts.default')

@section('title')
@parent
Reset Password
@stop

@section('content')
<p class="lead">Please enter your details:</p>
<div class="well">
    <form class="form-horizontal" action="{{ URL::route('account.reset.post') }}" method="post">   
        {{ Form::token() }}
        
        <div class="control-group {{ ($errors->has('email')) ? 'error' : '' }}" for="email">
            <label class="control-label" for="email">Email Address</label>
            <div class="controls">
                <input name="email" id="email" value="{{ Request::old('email') }}" type="text" class="input-xlarge" placeholder="Email Address">
                {{ ($errors->has('email') ? $errors->first('email') : '') }}
            </div>
        </div>

        <div class="form-actions">
            <button class="btn btn-primary" type="submit"><i class="icon-rocket"></i> Reset Password</button>
        </div>
  </form>
</div>

@stop
