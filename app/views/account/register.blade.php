@extends('layouts.default')

@section('title')
Register
@stop

@section('controls')
@if(Config::get('cms.regallowed') === true)
    <p class="lead">Please enter your details:</p>
@else
    <p class="lead">Registration is currently disabled.</p>
@endif

@stop

@section('content')
@if(Config::get('cms.regallowed') === true)
    <div class="well">
        {{ Form::open(array('url' => URL::route('account.register.post'), 'method' => 'POST', 'class' => 'form-horizontal')) }}

            <div class="form-group{{ ($errors->has('first_name')) ? ' has-error' : '' }}">
                <label class="col-lg-2 control-label" for="first_name">First Name</label>
                <div class="col-lg-3">
                    <input name="first_name" id="first_name" value="{{ Request::old('first_name') }}" type="text" class="form-control" placeholder="First Name">
                    {{ ($errors->has('first_name') ? $errors->first('first_name') : '') }}
                </div>
            </div>

            <div class="form-group{{ ($errors->has('last_name')) ? ' has-error' : '' }}">
                <label class="col-lg-2 control-label" for="last_name">Last Name</label>
                <div class="col-lg-3">
                    <input name="last_name" id="last_name" value="{{ Request::old('last_name') }}" type="text" class="form-control" placeholder="Last Name">
                    {{ ($errors->has('last_name') ? $errors->first('last_name') : '') }}
                </div>
            </div>

            <div class="form-group{{ ($errors->has('email')) ? ' has-error' : '' }}">
                <label class="col-lg-2 control-label" for="email">Email</label>
                <div class="col-lg-3">
                    <input name="email" id="email" value="{{ Request::old('email') }}" type="text" class="form-control" placeholder="Email">
                    {{ ($errors->has('email') ? $errors->first('email') : '') }}
                </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label class="col-lg-2 control-label" for="password">Password</label>
                <div class="col-lg-3">
                    <input name="password" id="password" value="" type="password" class="form-control" placeholder="Password">
                    {{ ($errors->has('password') ?  $errors->first('password') : '') }}
                </div>
            </div>

            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                <label class="col-lg-2 control-label" for="password_confirmation">Confirm Password</label>
                <div class="col-lg-3">
                    <input name="password_confirmation" id="password_confirmation" value="" type="password" class="form-control" placeholder="Confirm Password">
                    {{ ($errors->has('password_confirmation') ? $errors->first('password_confirmation') : '') }}
                </div>
            </div>

            <div class="form-group">
            <div class="col-lg-offset-2 col-lg-6">
                <button class="btn btn-primary" type="submit"><i class="fa fa-rocket"></i> Register</button>
                <button class="btn btn-inverse" type="reset">Reset</button>
            </div>
        </div>
        {{ Form::close() }}
    </div>
@endif
@stop
