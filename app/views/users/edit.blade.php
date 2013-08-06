@extends('layouts.default')

@section('title')
Edit {{ $user->first_name.' '.$user->last_name }}
@stop

@section('controls')
<p class="lead">
    Currently editing   
    @if($user->id == Sentry::getUser()->id)
        your 
    @else
        {{ $user->first_name.' '.$user->last_name }}'s 
    @endif
    profile:
</p>
@stop

@section('content')
<h4>Change Permissions</h4>
<div class="well">
    <form class="form-horizontal" action="{{ URL::to('users/updatememberships') }}/{{ $user->id }}" method="post">
        {{ Form::token() }}

        <table class="table">
            <thead>
                <th>Group</th>
                <th>Membership Status</th>
            </thead>
            <tbody>
                @foreach ($allGroups as $group)
                    <tr>
                        <td>{{ $group->name }}</td>
                        <td>
                            <div class="make-switch" data-on-label="In" data-on='info' data-off-label="Out">
                                <input name="permissions[{{ $group->id }}]" type="checkbox" {{ ( $user->inGroup($group)) ? 'checked' : '' }} >
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="form-actions">
            <input class="btn-primary btn" type="submit" value="Update Memberships">
        </div> 
    </form>
</div>
@endif    
@stop
