@extends('layouts.default')

@section('title')
Profile
@stop

@section('controls')
<div class="row-fluid">
    <div class="col-xs-8">
        <p class="lead">
            Here is your profile:
        </p>
    </div>
    <div class="col-xs-4">
        <div class="pull-right">
            <a class="btn btn-danger" href="#delete_account" data-toggle="modal" data-target="#delete_account"><i class="fa fa-times"></i> Delete Account</a>
        </div>
    </div>
</div>
<hr>
@stop

@section('content')
<h3>Change Details</h3>
<div class="well">
    <?php
    $form = array('url' => URL::route('account.details.patch'),
        'method' => 'PATCH',
        'button' => 'Save Details',
        'defaults' => array(
            'first_name' => Sentry::getUser()->first_name,
            'last_name' => Sentry::getUser()->last_name,
            'email' => Sentry::getUser()->email,
    ));
    ?>
    @include('account.details')
</div>
<hr>
<h3>Change Password</h3>
<div class="well">
    <?php
    $form = array('url' => URL::route('account.password.patch'),
        'method' => 'PATCH',
        'button' => 'Save Password',
    );
    ?>
    @include('account.password')
</div>
@stop

@section('messages')
@include('account.delete')
@stop

@section('css')
{{ Basset::show('form.css') }}
@stop

@section('js')
{{ Basset::show('form.js') }}
@stop
