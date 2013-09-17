<?php namespace GrahamCampbell\BootstrapCMS\Controllers;

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
 *
 * @package    Bootstrap-CMS
 * @author     Graham Campbell
 * @license    GNU AFFERO GENERAL PUBLIC LICENSE
 * @copyright  Copyright (C) 2013  Graham Campbell
 * @link       https://github.com/GrahamCampbell/Bootstrap-CMS
 */

use Event;
use Log;
use Redirect;
use Session;
use URL;
use Validator;

use Binput;
use Sentry;

use GrahamCampbell\CMSCore\Models\Page;

class LoginController extends BaseController {

    /**
     * Constructor (setup access permissions).
     *
     * @return void
     */
    public function __construct() {
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
    public function getLogin() {
        return $this->viewMake('account.login');
    }

    /**
     * Attempt to login the specified user.
     *
     * @return \Illuminate\Http\Response
     */
    public function postLogin() {
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
            Event::fire('user.loginfailed', array('Email' => $input['email'], 'Messages' => $val->messages()->all()));
            return Redirect::route('account.login')->withInput()->withErrors($val);
        }

        try {
            $throttle = Sentry::getThrottleProvider()->findByUserLogin($input['email']);
            $throttle->check();

            Sentry::authenticate($input, $remember);
        } catch (\Cartalyst\Sentry\Users\UserNotFoundException $e) {
            Log::notice($e);
            Event::fire('user.loginfailed', array('Email' => $input['email']));
            Session::flash('error', 'Your details were incorrect.');
            return Redirect::route('account.login')->withErrors($val)->withInput();
        } catch (\Cartalyst\Sentry\Users\WrongPasswordException $e) {
            Log::notice($e);
            Event::fire('user.loginfailed', array('Email' => $input['email']));
            Session::flash('error', 'Your password was incorrect.');
            return Redirect::route('account.login')->withErrors($val)->withInput();
        } catch (\Cartalyst\Sentry\Users\UserNotActivatedException $e) {
            Log::notice($e);
            Event::fire('user.loginfailed', array('Email' => $input['email']));
            Session::flash('error', 'You have not yet activated this account.');
            return Redirect::route('account.login')->withErrors($val)->withInput();
        } catch (\Cartalyst\Sentry\Throttling\UserSuspendedException $e) {
            Log::notice($e);
            Event::fire('user.loginfailed', array('Email' => $input['email']));
            $time = $throttle->getSuspensionTime();
            Session::flash('error', "Your account has been suspended for $time minutes.");
            return Redirect::route('account.login')->withErrors($val)->withInput();
        } catch (\Cartalyst\Sentry\Throttling\UserBannedException $e) {
            Log::notice($e);
            Event::fire('user.loginfailed', array('Email' => $input['email']));
            Session::flash('error', 'You have been banned. Please contact support.');
            return Redirect::route('account.login')->withErrors($val)->withInput();
        }

        Event::fire('user.loginsuccessful', array('Email' => $input['email']));
        return Redirect::intended(URL::route('pages.show', array('pages' => 'home')));
    }

    /**
     * Logout the specified user.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogout() {
        Event::fire('user.logout', array('Email' => Sentry::getUser()->email));
        Sentry::logout();
        return Redirect::route('pages.show', array('pages' => 'home'));
    }
}
