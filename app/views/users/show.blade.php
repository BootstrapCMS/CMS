@extends('layouts.default')

@section('title')
{{ $user->getName() }}
@stop

@section('controls')
<div class="row-fluid">
    <div class="span12">
        <div class="span6">
            <p class="lead">
                @if($user->id == Sentry::getUser()->id)
                    Currently showing your profile:
                @else
                    Currently showing {{ $user->getName() }}'s profile:
                @endif  
            </p>
        </div>
        <div class="span6">
            <div class="pull-right">
                <a class="btn btn-info" href="{{ URL::route('users.edit', array('users' => $user->getId())) }}"><i class="icon-edit"></i> Edit User</a> <a class="btn btn-danger" href="#delete_user" data-toggle="modal" data-target="#delete_user"><i class="icon-remove"></i> Delete User</a>
            </div>
        </div>
    </div>
</div>
<hr>
@stop

@section('content')
<h3>User Profile</h3>
<div class="well clearfix">
    <div class="span7">
        @if ($user->first_name)
            <p><strong>First Name:</strong> {{ $user->getFirstName() }} </p>
        @endif
        @if ($user->last_name)
            <p><strong>Last Name:</strong> {{ $user->getLastName() }} </p>
        @endif
        <p><strong>Email:</strong> {{ $user->getEmail() }}</p>
    </div>
    <div class="span4">
        <p><em>Account created: {{ $user->getCreatedAt() }}</em></p>
        <p><em>Last Updated: {{ $user->getUpdatedAt() }}</em></p>
    </div>
</div>
<hr>
<h3>User Group Memberships</h3>
<div class="well">
    <ul>
    @if (count($user->getGroups()) >= 1)
        @foreach ($user->getGroups() as $group)
            <li>{{ $group['name'] }}</li>
        @endforeach
    @else
        <li>No Group Memberships.</li>
    @endif
    </ul>
</div>
<hr>
<h3>User Object</h3>
<div>
    <pre>{{ var_dump($user) }}</pre>
</div>
@stop

@section('messages')
@if (Sentry::check() && Sentry::getUser()->hasAccess('admin'))
    @include('users.delete')
@endif
@stop
