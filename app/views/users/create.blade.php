@extends('layouts.default')

@section('title')
Create User
@stop

@section('content')
<div class="well">
    <?php
    $form = array('url' => URL::route('users.store'),
        'method' => 'POST',
        'button' => 'Create New User',
        'defaults' => array(
            'first_name' => '',
            'last_name' => '',
            'email' => '',
    ));
    foreach($groups as $group) {
        if ($group->name == 'Users') {
            $form['defaults']['group_'.$group->id] = true;
        } else {
            $form['defaults']['group_'.$group->id] = false;
        }
    }
    ?>
    @include('users.form')
</div>
@stop

@section('css')
{{ Basset::show('switches.css') }}
@stop

@section('js')
{{ Basset::show('switches.js') }}
@stop
