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

use Cartalyst\Sentry\Facades\Laravel\Sentry;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use GrahamCampbell\Binput\Facades\Binput;
use GrahamCampbell\Credentials\Facades\Viewer;
use GrahamCampbell\CMSCore\Models\Page;
use GrahamCampbell\CMSCore\Controllers\AbstractController;

/**
 * This is the login controller class.
 *
 * @package    Bootstrap-CMS
 * @author     Graham Campbell
 * @copyright  Copyright (C) 2013  Graham Campbell
 * @license    https://github.com/GrahamCampbell/Bootstrap-CMS/blob/develop/LICENSE.md
 * @link       https://github.com/GrahamCampbell/Bootstrap-CMS
 */
class LoginController extends AbstractController
{
    /**
     * Constructor (setup access permissions).
     *
     * @return void
     */
    public function __construct()
    {
        $this->setPermissions(array(
            'getLogout' => 'user',
        ));

        parent::__construct();
    }

    /**
     * Display the login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogin()
    {
        return Viewer::make(Config::get('views.login', 'account.login'));
    }

    /**
     * Attempt to login the specified user.
     *
     * @return \Illuminate\Http\Response
     */
    public function postLogin()
    {
        $remember = Binput::get('rememberMe');

        $input = array(
            'email'    => Binput::get('email'),
            'password' => Binput::get('password'),
        );

        $rules = array(
            'email'    => 'required|min:4|max:32|email',
            'password' => 'required|min:6',
        );

        $val = Validator::make($input, $rules);
        if ($val->fails()) {
            Event::fire('user.loginfailed', array(array('Email' => $input['email'], 'Messages' => $val->messages()->all())));
            return Redirect::route('account.login')->withInput()->withErrors($val);
        }

        try {
            $throttle = Sentry::getThrottleProvider()->findByUserLogin($input['email']);
            $throttle->check();

            Sentry::authenticate($input, $remember);
        } catch (\Cartalyst\Sentry\Users\WrongPasswordException $e) {
            Log::notice($e);
            Event::fire('user.loginfailed', array(array('Email' => $input['email'])));
            Session::flash('error', 'Your password was incorrect.');
            return Redirect::route('account.login')->withErrors($val)->withInput();
        } catch (\Cartalyst\Sentry\Users\UserNotFoundException $e) {
            Log::notice($e);
            Event::fire('user.loginfailed', array(array('Email' => $input['email'])));
            Session::flash('error', 'That user does not exist.');
            return Redirect::route('account.login')->withErrors($val)->withInput();
        } catch (\Cartalyst\Sentry\Users\UserNotActivatedException $e) {
            Log::notice($e);
            Event::fire('user.loginfailed', array(array('Email' => $input['email'])));
            Session::flash('error', 'You have not yet activated this account.');
            return Redirect::route('account.login')->withErrors($val)->withInput();
        } catch (\Cartalyst\Sentry\Throttling\UserSuspendedException $e) {
            Log::notice($e);
            Event::fire('user.loginfailed', array(array('Email' => $input['email'])));
            $time = $throttle->getSuspensionTime();
            Session::flash('error', "Your account has been suspended for $time minutes.");
            return Redirect::route('account.login')->withErrors($val)->withInput();
        } catch (\Cartalyst\Sentry\Throttling\UserBannedException $e) {
            Log::notice($e);
            Event::fire('user.loginfailed', array(array('Email' => $input['email'])));
            Session::flash('error', 'You have been banned. Please contact support.');
            return Redirect::route('account.login')->withErrors($val)->withInput();
        }

        Event::fire('user.loginsuccessful', array(array('Email' => $input['email'])));
        return Redirect::intended(URL::route('pages.show', array('pages' => 'home')));
    }

    /**
     * Logout the specified user.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogout()
    {
        Event::fire('user.logout', array(array('Email' => Sentry::getUser()->email)));
        Sentry::logout();
        return Redirect::route('pages.show', array('pages' => 'home'));
    }
}
