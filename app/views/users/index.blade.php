@extends('layouts.default')

@section('title')
@parent
Users
@stop

@section('content')

  @if (Sentry::check())
    @if($user->hasAccess('admin'))
        <p class="lead">Here is a list of all the current users:</p>
        <div class="well">
            <table class="table">
                <thead>
                    <th>User</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Options</th>
                </thead>
                <tbody>
                    @foreach ($allUsers as $user)
                        <tr>
                            <td>{{ $user->first_name.' '.$user->last_name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $userStatus[$user->id] }} </td>
                            <td>
                                <button class="btn" onClick="location.href='{{ URL::to('users/show') }}/{{ $user->id}}'">Show</button>
                                <button class="btn" onClick="location.href='{{ URL::to('users/edit') }}/{{ $user->id}}'">Edit</button>
                                <button class="btn" onClick="location.href='{{ URL::to('users/suspend') }}/{{ $user->id}}'">Suspend</button>
                                <button class="btn action_confirm" href="{{ URL::to('users/delete') }}/{{ $user->id}}" data-token="{{ Session::getToken() }}" data-method="post">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else 
        <h4>You are not an Administrator</h4>
    @endif
  @else
    <h4>You are not logged in</h4>
  @endif

@stop
