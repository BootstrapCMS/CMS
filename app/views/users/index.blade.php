@extends(Config::get('views.default', 'layouts.default'))

@section('title')
Users
@stop

@section('controls')
<div class="row">
    <div class="col-xs-8">
        <p class="lead">Here is a list of all the current users:</p>
    </div>
    @if (Sentry::check() && Sentry::getUser()->hasAccess('admin'))
        <div class="col-xs-4">
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ URL::route('users.create') }}"><i class="fa fa-user"></i> New User</a>
            </div>
        </div>
    @endif
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
                        &nbsp;<a class="btn btn-success" href="{{ URL::route('users.show', array('users' => $user->getId())) }}"><i class="fa fa-file-text"></i> Show</a>
                        @if (Sentry::check() && Sentry::getUser()->hasAccess('admin'))
                            &nbsp;<a class="btn btn-info" href="{{ URL::route('users.edit', array('users' => $user->getId())) }}"><i class="fa fa-pencil-square-o"></i> Edit</a>
                        @endif
                        &nbsp;<a class="btn btn-warning" href="#suspend_user_{{ $user->getId() }}" data-toggle="modal" data-target="#suspend_user_{{ $user->getId() }}"><i class="fa fa-ban"></i> Suspend</a>
                        @if (Sentry::check() && Sentry::getUser()->hasAccess('admin'))
                            &nbsp;<a class="btn btn-inverse" href="#reset_user_{{ $user->getId() }}" data-toggle="modal" data-target="#reset_user_{{ $user->getId() }}"><i class="fa fa-lock"></i> Reset Password</a>
                            &nbsp;<a class="btn btn-danger" href="#delete_user_{{ $user->getId() }}" data-toggle="modal" data-target="#delete_user_{{ $user->getId() }}"><i class="fa fa-times"></i> Delete</a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{ $links }}
@stop

@section('messages')
@include('users.suspends')
@if (Sentry::check() && Sentry::getUser()->hasAccess('admin'))
    @include('users.resets')
    @include('users.deletes')
@endif
@stop
