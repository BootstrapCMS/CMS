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

use App;
use Config;
use Event;
use Log;
use Queuing;
use Redirect;
use Session;
use URL;
use Validator;

use Binput;
use Sentry;

class RegistrationController extends BaseController {

    /**
     * Constructor (setup access permissions).
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Display the registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRegister() {
        return $this->viewMake('account.register');
    }

    /**
     * Attempt to register a new user.
     *
     * @return \Illuminate\Http\Response
     */
    public function postRegister() {
        if (!Config::get('cms.regallowed')) {
            return Redirect::route('account.register');
        }

        $input = array(
            'first_name'            => Binput::get('first_name'),
            'last_name'             => Binput::get('last_name'),
            'email'                 => Binput::get('email'),
            'password'              => Binput::get('password'),
            'password_confirmation' => Binput::get('password_confirmation')
        );

        $rules = array (
            'first_name'            => 'required|min:2|max:32',
            'last_name'             => 'required|min:2|max:32',
            'email'                 => 'required|min:4|max:32|email',
            'password'              => 'required|min:6|confirmed',
            'password_confirmation' => 'required'
        );

        $val = Validator::make($input, $rules);
        if ($val->fails()) {
            Event::fire('user.registrationfailed', array(array('Email' => $input['email'], 'Messages' => $val->messages()->all())));
            return Redirect::route('account.register')->withErrors($val)->withInput();
        }

        try {
            unset($input['password_confirmation']);

            $user = Sentry::register($input);

            if (!Config::get('cms.regemail')) {
                $user->attemptActivation($user->GetActivationCode());
                $user->addGroup(Sentry::getGroupProvider()->findByName('Users'));

                Event::fire('user.registrationsuccessful', array(array('Email' => $input['email'], 'Activated' => true)));
                Session::flash('success', 'Your account has been created successfully.');
                return Redirect::route('pages.show', array('pages' => 'home'));
            }

            try {
                $data = array(
                    'view'    => 'emails.welcome',
                    'url'     => URL::route('pages.show', array('pages' => 'home')),
                    'link'    => URL::route('account.activate', array('id' => $user->getId(), 'code' => $user->GetActivationCode())),
                    'email'   => $user->getLogin(),
                    'subject' => Config::get('cms.name').' - Welcome',
                );

                Queuing::push('GrahamCampbell\BootstrapCMS\Handlers\MailHandler', $data, Config::get('mail.queue'));
            } catch (\Exception $e) {
                Log::alert($e);
                Event::fire('user.registrationfailed', array(array('Email' => $input['email'])));
                $user->delete();
                Session::flash('error', 'We were unable to create your account. Please contact support.');
                return Redirect::route('account.register')->withInput();
            }

            Event::fire('user.registrationsuccessful', array(array('Email' => $input['email'], 'Activated' => false)));
            Session::flash('success', 'Your account has been created. Check your email for the confirmation link.');
            return Redirect::route('pages.show', array('pages' => 'home'));
        } catch (\Cartalyst\Sentry\Users\UserExistsException $e) {
            Log::notice($e);
            Event::fire('user.registrationfailed', array(array('Email' => $input['email'])));
            Session::flash('error', 'That email address is taken.');
            return Redirect::route('account.register')->withInput()->withErrors($val);
        }
    }

    /**
     * Activate an existing user.
     *
     * @return \Illuminate\Http\Response
     */
    public function getActivate($id = null, $code = null) {
        if ($id === null || $code === null) {
            App::abort(400);
        }

        try {
            $user = Sentry::getUserProvider()->findById($id);

            if (!$user->attemptActivation($code)) {
                Session::flash('error', 'There was a problem activating this account. Please contact support.');
                return Redirect::route('pages.show', array('pages' => 'home'));
            }

            $user->addGroup(Sentry::getGroupProvider()->findByName('Users'));

            Event::fire('user.activationsuccessful', array(array('Email' => $user->email)));
            Session::flash('success', 'Your account has been activated successfully. You may now login.');
            return Redirect::route('account.login', array('pages' => 'home'));
        } catch (\Cartalyst\Sentry\Users\UserNotFoundException $e) {
            Log::error($e);
            Event::fire('user.activationfailed');
            Session::flash('error', 'There was a problem activating this account. Please contact support.');
            return Redirect::route('pages.show', array('pages' => 'home'));
        } catch (\Cartalyst\SEntry\Users\UserAlreadyActivatedException $e) {
            Log::notice($e);
            Event::fire('user.activationfailed', array(array('Email' => $user->email)));
            Session::flash('warning', 'You have already activated this account. You may want to login.');
            return Redirect::route('account.login', array('pages' => 'home'));
        }
    }
}
