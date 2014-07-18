@extends(Config::get('views.default', 'layouts.default'))

@section('title')
<?php $__navtype = 'admin'; ?>
{{{ $user->name }}}
@stop

@section('top')
<div class="page-header">
<h1>{{{ $user->name }}}</h1>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-lg-6">
        <p class="lead">
            @if($user->id == Credentials::getUser()->id)
                Currently showing your profile:
            @else
                Currently showing {{ $user->name }}'s profile:
            @endif
        </p>
    </div>
    <div class="col-lg-6">
        <div class="pull-right visible-lg">
            @auth('admin')
                &nbsp;<a class="btn btn-info" href="{{ URL::route('users.edit', array('users' => $user->id)) }}"><i class="fa fa-pencil-square-o"></i> Edit User</a>
            @endauth
            &nbsp;<a class="btn btn-warning" href="#suspend_user" data-toggle="modal" data-target="#suspend_user"><i class="fa fa-ban"></i> Suspend User</a>
            @auth('admin')
                &nbsp;<a class="btn btn-inverse" href="#reset_user" data-toggle="modal" data-target="#reset_user"><i class="fa fa-lock"></i> Reset Password</a>
                &nbsp;<a class="btn btn-danger" href="#delete_user" data-toggle="modal" data-target="#delete_user"><i class="fa fa-times"></i> Delete</a>
            @endauth
        </div>
    </div>
    <div class="col-lg-6 hidden-lg">
        @auth('admin')
            &nbsp;<a class="btn btn-info" href="{{ URL::route('users.edit', array('users' => $user->id)) }}"><i class="fa fa-pencil-square-o"></i> Edit User</a>
        @endauth
        &nbsp;<a class="btn btn-warning" href="#suspend_user" data-toggle="modal" data-target="#suspend_user"><i class="fa fa-ban"></i> Suspend User</a>
        @auth('admin')
            &nbsp;<a class="btn btn-inverse" href="#reset_user" data-toggle="modal" data-target="#reset_user"><i class="fa fa-lock"></i> Reset Password</a>
            &nbsp;<a class="btn btn-danger" href="#delete_user" data-toggle="modal" data-target="#delete_user"><i class="fa fa-times"></i> Delete</a>
        @endauth
    </div>
</div>
<hr>
<h3>User Profile</h3>
<div class="well clearfix">
    <div class="hidden-xs">
        <div class="col-xs-6">
            @if ($user->first_name)
                <p><strong>First Name:</strong> {{ $user->first_name }} </p>
            @endif
            @if ($user->last_name)
                <p><strong>Last Name:</strong> {{ $user->last_name }} </p>
            @endif
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Groups:</strong> {{ $groups }}</strong>
        </div>
        <div class="col-xs-6">
            <div class="pull-right">
                <p><em>Account Created: {{ HTML::ago($user->created_at) }}</em></p>
                <p><em>Account Updated: {{ HTML::ago($user->updated_at) }}</em></p>
                <p><em>Account Activated: {{ $activated }}</em></p>
                <p><em>Account Suspended: {{ $suspended }}</em></p>
            </div>
        </div>
    </div>
    <div class="visible-xs">
        <div class="col-xs-12">
            @if ($user->first_name)
                <p><strong>First Name:</strong> {{ $user->first_name }} </p>
            @endif
            @if ($user->last_name)
                <p><strong>Last Name:</strong> {{ $user->last_name }} </p>
            @endif
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Groups:</strong> {{ $groups }}</p>
            <p><strong>Account Created:</strong> {{ HTML::ago($user->created_at) }}</p>
            <p><strong>Account Updated:</strong> {{ HTML::ago($user->updated_at) }}</p>
            <p><strong>Account Activated:</strong> {{ $activated }}</p>
            <p><strong>Account Suspended:</strong> {{ $suspended }}</p>
        </div>
    </div>
</div>
<hr>
<div class="col-md-6">
    <h3>Security History</h3>
    <hr>
    @if (empty($securityEvents = $user->securityHistory->toArray()))
        <div class="lead">No notable events have occurred yet.</div>
    @else
        @foreach($securityEvents as $event)
            <div class="well clearfix">
                <p><strong>{{{ $event->title }}}</strong> - {{ HTML::ago($event->updated_at) }}</p>
                {{{ $event->description }}}</p>
            </div>
        @endforeach
    @endif
</div>
<hr class="hidden-lg">
<div class="col-md-6">
    <h3>Recent Actions</h3>
    <hr>
    @if (empty($actionEvents = $user->actionHistory->toArray()))
        <div class="lead">No notable events have occurred yet.</div>
    @else
        @foreach($actionEvents as $event)
            <div class="well clearfix">
                <p><strong>{{{ 'EVENT TITLE' }}}</strong> - {{ 'EVENT DATE' }}</p>
                {{{ 'EVENT DESCRIPTION' }}}</p>
            </div>
        @endforeach
    @endif
</div>
@stop

@section('bottom')
@include('graham-campbell/credentials::users.suspend')
@auth('admin')
    @if (Config::get('graham-campbell/credentials::activation'))
        @include('graham-campbell/credentials::users.resend')
    @endif
    @include('graham-campbell/credentials::users.reset')
    @include('graham-campbell/credentials::users.delete')
@endauth
@stop
