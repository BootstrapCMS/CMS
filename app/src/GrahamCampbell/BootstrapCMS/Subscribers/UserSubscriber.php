<?php namespace GrahamCampbell\BootstrapCMS\Subscribers;

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

use Log;

class UserSubscriber {

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     * @return array
     */
    public function subscribe($events) {
        $events->listen('user.loginsuccessful', 'GrahamCampbell\BootstrapCMS\Subscribers\ExtraUserSubscriber@onUserLoginSuccessful');
        $events->listen('user.loginfailed', 'GrahamCampbell\BootstrapCMS\Subscribers\ExtraUserSubscriber@onUserLoginFailed');
        $events->listen('user.logout', 'GrahamCampbell\BootstrapCMS\Subscribers\ExtraUserSubscriber@onUserLogout');
        $events->listen('user.registrationsuccessful', 'GrahamCampbell\BootstrapCMS\Subscribers\ExtraUserSubscriber@onUserRegistrationSuccessful');
        $events->listen('user.registrationfailed', 'GrahamCampbell\BootstrapCMS\Subscribers\ExtraUserSubscriber@onUserRegistrationFailed');
        $events->listen('user.activationsuccessful', 'GrahamCampbell\BootstrapCMS\Subscribers\ExtraUserSubscriber@onUserActivationSuccessful');
        $events->listen('user.activationfailed', 'GrahamCampbell\BootstrapCMS\Subscribers\ExtraUserSubscriber@onUserActivationFailed');
    }

    /**
     * Handle a user.loginsuccessful event.
     *
     * @param  mixed  $event
     * @return void
     */
    public function onUserLoginSuccessful($event) {
        if (!is_array($event)) {
            $event = array($event);
        }
        Log::info('User login successful', $event);
    }

    /**
     * Handle a user.loginfailed event.
     *
     * @param  mixed  $event
     * @return void
     */
    public function onUserLoginFailed($event) {
        if (!is_array($event)) {
            $event = array($event);
        }
        Log::notice('User login failed', $event);
    }

    /**
     * Handle a user.logout event.
     *
     * @param  mixed  $event
     * @return void
     */
    public function onUserLogout($event) {
        if (!is_array($event)) {
            $event = array($event);
        }
        Log::info('User logged out', $event);
    }

    /**
     * Handle a user.registrationsuccessful event.
     *
     * @param  mixed  $event
     * @return void
     */
    public function onUserRegistrationSuccessful($event) {
        if (!is_array($event)) {
            $event = array($event);
        }
        Log::info('User registration successful', $event);
    }

    /**
     * Handle a user.registrationfailed event.
     *
     * @param  mixed  $event
     * @return void
     */
    public function onUserRegistrationFailed($event) {
        if (!is_array($event)) {
            $event = array($event);
        }
        Log::notice('User registration failed', $event);
    }

    /**
     * Handle a user.activationsuccessful event.
     *
     * @param  mixed  $event
     * @return void
     */
    public function onUserActivationSuccessful($event) {
        if (!is_array($event)) {
            $event = array($event);
        }
        Log::info('User activation successful', $event);
    }

    /**
     * Handle a user.activationfailed event.
     *
     * @param  mixed  $event
     * @return void
     */
    public function onUserActivationFailed($event) {
        if (!is_array($event)) {
            $event = array($event);
        }
        Log::notice('User activation failed', $event);
    }
}
