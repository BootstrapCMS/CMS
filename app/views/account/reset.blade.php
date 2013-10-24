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

        <div class="form-group{{ ($errors->has('email')) ? ' has-error' : '' }}">
            <label class="col-lg-2 control-label" for="email">Email Address</label>
            <div class="col-lg-3">
                <input name="email" id="email" value="{{ Request::old('email') }}" type="text" class="form-control" placeholder="Email Address">
                {{ ($errors->has('email') ? $errors->first('email') : '') }}
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-offset-2 col-lg-6">
                <button class="btn btn-primary" type="submit"><i class="fa fa-rocket"></i> Reset Password</button>
            </div>
        </div>

    {{ Form::close() }}
</div>
@stop
