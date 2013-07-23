@extends('layouts.default')

@section('title')
@parent
Edit {{ $page->title }}
@stop

@section('content')
COMING SOON!
<div class="well">
    <form class="form-horizontal" action="{{ URL::to('groups') }}/{{ $group['id'] }}" method="POST">   
        {{ Form::token() }}
        <input type="hidden" name="_method" value="PUT">
    
        <div class="control-group {{ ($errors->has('name')) ? 'error' : '' }}" for="name">
            <label class="control-label" for="name">Name</label>
            <div class="controls">
                <input name="name" value="{{ (Request::old('name')) ? Request::old('name') : $group->name }}" type="text" class="input-xlarge" placeholder="Name">
                {{ ($errors->has('name') ? $errors->first('name') : '') }}
            </div>
        </div>

        <div class="control-group" for="permissions">
            <label class="control-label" for="permissions">Permissions</label>
            <div class="controls">
                <label class="checkbox inline">
                    <input type="checkbox" value="1" name="adminPermissions" @if ( isset($group['permissions']['admin']) ) checked @endif> Admin
                </label>
                <label class="checkbox inline">
                    <input type="checkbox" value="1" name="userPermissions" @if ( isset($group['permissions']['users']) ) checked @endif> User
                </label>
            </div>
        </div>
        
        <div class="form-actions">
            <button class="btn btn-primary" type="submit">Save Changes</button>
        </div>
  </form>
</div>

@stop
