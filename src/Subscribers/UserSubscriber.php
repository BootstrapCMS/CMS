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

namespace GrahamCampbell\BootstrapCMS\Subscribers;

use Illuminate\Events\Dispatcher;
use Illuminate\Support\Facades\Log;

/**
 * This is the user subscriber class.
 *
 * @package    Bootstrap-CMS
 * @author     Graham Campbell
 * @copyright  Copyright (C) 2013-2014  Graham Campbell
 * @license    https://github.com/GrahamCampbell/Bootstrap-CMS/blob/master/LICENSE.md
 * @link       https://github.com/GrahamCampbell/Bootstrap-CMS
 */
class UserSubscriber
{
    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     * @return array
     */
    public function subscribe(Dispatcher $events)
    {
        $events->listen('user.loginsuccessful', 'GrahamCampbell\BootstrapCMS\Subscribers\UserSubscriber@onUserLoginSuccessful', 5);
        $events->listen('user.loginfailed', 'GrahamCampbell\BootstrapCMS\Subscribers\UserSubscriber@onUserLoginFailed', 5);
        $events->listen('user.logout', 'GrahamCampbell\BootstrapCMS\Subscribers\UserSubscriber@onUserLogout', 5);
        $events->listen('user.registrationsuccessful', 'GrahamCampbell\BootstrapCMS\Subscribers\UserSubscriber@onUserRegistrationSuccessful', 5);
        $events->listen('user.registrationfailed', 'GrahamCampbell\BootstrapCMS\Subscribers\UserSubscriber@onUserRegistrationFailed', 5);
        $events->listen('user.activationsuccessful', 'GrahamCampbell\BootstrapCMS\Subscribers\UserSubscriber@onUserActivationSuccessful', 5);
        $events->listen('user.activationfailed', 'GrahamCampbell\BootstrapCMS\Subscribers\UserSubscriber@onUserActivationFailed', 5);
    }

    /**
     * Handle a user.loginsuccessful event.
     *
     * @param  array  $event
     * @return void
     */
    public function onUserLoginSuccessful(array $event = array())
    {
        if (!is_array($event)) {
            $event = array($event);
        }
        Log::info('User login successful', $event);
    }

    /**
     * Handle a user.loginfailed event.
     *
     * @param  array  $event
     * @return void
     */
    public function onUserLoginFailed(array $event = array())
    {
        if (!is_array($event)) {
            $event = array($event);
        }
        Log::notice('User login failed', $event);
    }

    /**
     * Handle a user.logout event.
     *
     * @param  array  $event
     * @return void
     */
    public function onUserLogout(array $event = array())
    {
        if (!is_array($event)) {
            $event = array($event);
        }
        Log::info('User logged out', $event);
    }

    /**
     * Handle a user.registrationsuccessful event.
     *
     * @param  array  $event
     * @return void
     */
    public function onUserRegistrationSuccessful(array $event = array())
    {
        if (!is_array($event)) {
            $event = array($event);
        }
        Log::info('User registration successful', $event);
    }

    /**
     * Handle a user.registrationfailed event.
     *
     * @param  array  $event
     * @return void
     */
    public function onUserRegistrationFailed(array $event = array())
    {
        if (!is_array($event)) {
            $event = array($event);
        }
        Log::notice('User registration failed', $event);
    }

    /**
     * Handle a user.activationsuccessful event.
     *
     * @param  array  $event
     * @return void
     */
    public function onUserActivationSuccessful(array $event = array())
    {
        if (!is_array($event)) {
            $event = array($event);
        }
        Log::info('User activation successful', $event);
    }

    /**
     * Handle a user.activationfailed event.
     *
     * @param  array  $event
     * @return void
     */
    public function onUserActivationFailed(array $event = array())
    {
        if (!is_array($event)) {
            $event = array($event);
        }
        Log::notice('User activation failed', $event);
    }
}
