@extends('layouts.default')

@section('title')
@parent
Suspend User
@stop

@section('content')

<h4>Suspend {{ $user->email }}</h4>
<div class="well">
    <form class="form-horizontal" action="{{ URL::to('users/suspend') }}/{{ $user->id }}" method="post">   
        {{ Form::token() }}
        
        <div class="control-group {{ ($errors->has('suspendTime')) ? 'error' : '' }}" for="suspendTime">
            <label class="control-label" for="suspendTime">Duration</label>
            <div class="controls">
                <input name="suspendTime" id="suspendTime" value="{{ Request::old('suspendTime') }}" type="text" class="input-xlarge" placeholder="Minutes">
                {{ ($errors->has('suspendTime') ? $errors->first('suspendTime') : '') }}
            </div>
        </div>

        <div class="form-actions">
            <button class="btn btn-primary" type="submit">Suspend User</button>
        </div>
  </form>
</div>

@stop
