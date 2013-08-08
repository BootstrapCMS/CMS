@extends('layouts.default')

@section('title')
Users
@stop

@section('controls')
<div class="row-fluid">
    <div class="span12">
        <div class="span6">
            <p class="lead">Here is a list of all the current users:</p>
        </div>
        @if (Sentry::check() && Sentry::getUser()->hasAccess('blog'))
            <div class="span6">
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ URL::route('users.create') }}"><i class="icon-user"></i> New User</a>
                </div>
            </div>
        @endif
    </div>
</div>
<hr>
@stop

@section('content')
<div class="well">
    <table class="table">
        <thead>
            <th>Name</th>
            <th>Email</th>
            <th>Options</th>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->getName() }}</td>
                    <td>{{ $user->getEmail() }}</td>
                    <td>
                        <a class="btn btn-success" href="{{ URL::route('users.show', array('users' => $user->getId())) }}"><i class="icon-file-text"></i> Show</a> <a class="btn btn-info" href="{{ URL::route('users.edit', array('users' => $user->getId())) }}"><i class="icon-edit"></i> Edit</a> <a class="btn btn-danger" href="#delete_user_{{ $user->getId() }}" data-toggle="modal" data-target="#delete_user_{{ $user->getId() }}"><i class="icon-remove"></i> Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@stop

@section('messages')
@if (Sentry::check() && Sentry::getUser()->hasAccess('admin'))
    @include('users.deletes')
@endif
@stop
