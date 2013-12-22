<?php

/**
 * This file is part of Bootstrap CMS by Graham Campbell.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 */

namespace GrahamCampbell\BootstrapCMS\Controllers;

use DateTime;
use Cartalyst\Sentry\Facades\Laravel\Sentry;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use GrahamCampbell\Binput\Facades\Binput;
use GrahamCampbell\Passwd\Facades\Passwd;
use GrahamCampbell\Queuing\Facades\Queuing;
use GrahamCampbell\Credentials\Facades\UserProvider;
use GrahamCampbell\Credentials\Facades\GroupProvider;
use GrahamCampbell\CMSCore\Controllers\AbstractController;

/**
 * This is the user controller class.
 *
 * @package    Bootstrap-CMS
 * @author     Graham Campbell
 * @copyright  Copyright (C) 2013  Graham Campbell
 * @license    https://github.com/GrahamCampbell/Bootstrap-CMS/blob/develop/LICENSE.md
 * @link       https://github.com/GrahamCampbell/Bootstrap-CMS
 */
class UserController extends AbstractController
{
    /**
     * Constructor (setup access permissions).
     *
     * @return void
     */
    public function __construct()
    {
        $this->setPermissions(array(
            'index'   => 'mod',
            'create'  => 'admin',
            'store'   => 'admin',
            'show'    => 'mod',
            'edit'    => 'admin',
            'update'  => 'admin',
            'suspend' => 'mod',
            'destroy' => 'admin',
        ));

        parent::__construct();
    }

    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = UserProvider::paginate();
        $links = UserProvider::links();

        return $this->viewMake('users.index', array('users' => $users, 'links' => $links), true);
    }

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $groups = GroupProvider::index();

        return $this->viewMake('users.create', array('groups' => $groups), true);
    }

    /**
     * Store a new user.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $password = Passwd::generate();

        $input = array(
            'first_name'      => Binput::get('first_name'),
            'last_name'       => Binput::get('last_name'),
            'email'           => Binput::get('email'),
            'password'        => $password,
            'activated'       => true,
            'activated_at'    => new DateTime
        );

        $rules = array(
            'first_name'   => 'required|min:2|max:32',
            'last_name'    => 'required|min:2|max:32',
            'email'        => 'required|min:4|max:32|email',
            'password'     => 'required|min:6',
            'activated'    => 'required',
            'activated_at' => 'required'
        );

        $val = Validator::make($input, $rules);
        if ($val->fails()) {
            return Redirect::route('users.create')->withInput()->withErrors($val->errors());
        }

        try {
            $user = UserProvider::create($input);

            $groups = GroupProvider::index();
            foreach ($groups as $group) {
                if (Binput::get('group_'.$group->id) === 'on') {
                    $user->addGroup($group);
                }
            }

            try {
                $data = array(
                    'view'     => 'emails.newuser',
                    'url'      => URL::route('pages.show', array('pages' => 'home')),
                    'password' => $password,
                    'email'    => $user->getLogin(),
                    'subject'  => Config::get('platform.name').' - New Account Information'
                );

                Queuing::pushMail($data);
            } catch (\Exception $e) {
                Log::alert($e);
                $user->delete();
                Session::flash('error', 'We were unable to create the user. Please contact support.');
                return Redirect::route('users.create')->withInput();
            }

            Session::flash('success', 'The user has been created successfully. Their password has been emailed to them.');
            return Redirect::route('users.show', array('users' => $user->getId()));
        } catch (\Cartalyst\Sentry\Users\UserExistsException $e) {
            Log::notice($e);
            Session::flash('error', 'That email address is taken.');
            return Redirect::route('users.create')->withInput()->withErrors($val);
        }
    }

    /**
     * Show the specified user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = UserProvider::find($id);
        $this->checkUser($user);

        return $this->viewMake('users.show', array('user' => $user), true);
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = UserProvider::find($id);
        $this->checkUser($user);

        $groups = GroupProvider::index();

        return $this->viewMake('users.edit', array('user' => $user, 'groups' => $groups), true);
    }

    /**
     * Update an existing user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $input = array(
            'first_name' => Binput::get('first_name'),
            'last_name'  => Binput::get('last_name'),
            'email'      => Binput::get('email')
        );

        $rules = array(
            'first_name' => 'required|min:2|max:32',
            'last_name'  => 'required|min:2|max:32',
            'email'      => 'required|min:4|max:32|email'
        );

        $val = Validator::make($input, $rules);
        if ($val->fails()) {
            return Redirect::route('users.edit', array('users' => $id))->withInput()->withErrors($val->errors());
        }

        $user = UserProvider::find($id);
        $this->checkUser($user);

        $user->update($input);

        $groups = GroupProvider::index();

        foreach ($groups as $group) {
            if ($user->inGroup($group)) {
                if (Binput::get('group_'.$group->id) !== 'on') {
                    $user->removeGroup($group);
                }
            } else {
                if (Binput::get('group_'.$group->id) === 'on') {
                    $user->addGroup($group);
                }
            }
        }

        Session::flash('success', 'The user has been updated successfully.');
        return Redirect::route('users.show', array('users' => $user->getId()));
    }

    /**
     * Suspend an existing user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function suspend($id)
    {
        try {
            $throttle = Sentry::getThrottleProvider()->findByUserId($id);
            $throttle->suspend();
        } catch (\Cartalyst\Sentry\Users\UserNotFoundException $e) {
            Log::notice($e);
            return App::abort(404, 'User Not Found');
        } catch (\Cartalyst\Sentry\Throttling\UserSuspendedException $e) {
            Log::notice($e);
            $time = $throttle->getSuspensionTime();
            Session::flash('error', "This user is already suspended for $time minutes.");
            return Redirect::route('users.suspend', array('users' => $user->getId()))->withErrors($val)->withInput();
        } catch (\Cartalyst\Sentry\Throttling\UserBannedException $e) {
            Log::notice($e);
            Session::flash('error', 'This user has already been banned.');
            return Redirect::route('users.suspend', array('users' => $user->getId()))->withErrors($val)->withInput();
        }

        Session::flash('success', 'The user has been suspended successfully.');
        return Redirect::route('users.show', array('users' => $id));
    }

    /**
     * Reset the password of an existing user.
     *
     * @return \Illuminate\Http\Response
     */
    public function reset($id)
    {
        $password = Passwd::generate();

        $input = array(
            'password' => $password,
        );

        $rules = array(
            'password' => 'required|min:6',
        );

        $val = Validator::make($input, $rules);
        if ($val->fails()) {
            return Redirect::route('users.show', array('users' => $id))->withErrors($val->errors());
        }

        $user = UserProvider::find($id);
        $this->checkUser($user);

        $user->update($input);

        try {
            $data = array(
                'view' => 'emails.password',
                'password' => $password,
                'email' => $user->getLogin(),
                'subject' => Config::get('platform.name').' - New Password Information',
            );

            Queuing::pushMail($data);
        } catch (\Exception $e) {
            Log::alert($e);
            Session::flash('error', 'We were unable to send the password to the user.');
            return Redirect::route('users.show', array('users' => $id));
        }

        Log::info('Password reset successfully', array('Email' => $data['email']));
        Session::flash('success', 'The user\'s password has been successfully reset. Their new password has been emailed to them.');
        return Redirect::route('users.show', array('users' => $id));
    }

    /**
     * Delete an existing user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = UserProvider::find($id);
        $this->checkUser($user);

        $user->delete();

        Session::flash('success', 'The user has been deleted successfully.');
        return Redirect::route('users.index');
    }

    /**
     * Check the user model.
     *
     * @param  mixed  $user
     * @return void
     */
    protected function checkUser($user)
    {
        if (!$user) {
            return App::abort(404, 'User Not Found');
        }
    }
}
