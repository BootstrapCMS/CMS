<?php namespace GrahamCampbell\BootstrapCMS\Subscribers;

use Log;

class ExtraUserSubscriber {

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
        $events->listen('user.registraionsuccessful', 'GrahamCampbell\BootstrapCMS\Subscribers\ExtraUserSubscriber@onUserRegistraionSuccessful');
        $events->listen('user.registraionfailed', 'GrahamCampbell\BootstrapCMS\Subscribers\ExtraUserSubscriber@onUserRegistraionFailed');
        $events->listen('user.activationsuccessful', 'GrahamCampbell\BootstrapCMS\Subscribers\ExtraUserSubscriber@onUserActivationSuccessful');
        $events->listen('user.activationfailed', 'GrahamCampbell\BootstrapCMS\Subscribers\ExtraUserSubscriber@onUserActivationFailed');
    }

    public function onUserLoginSuccessful($event) {
        if (!is_array($event)) {
            $event = array($event);
        }
        Log::info('User login successful', $event);
    }

    public function onUserLoginFailed($event) {
        if (!is_array($event)) {
            $event = array($event);
        }
        Log::notice('User login failed', $event);
    }

    public function onUserLogout($event) {
        if (!is_array($event)) {
            $event = array($event);
        }
        Log::info('User logged out', $event);
    }

    public function onUserRegistraionSuccessful($event) {
        if (!is_array($event)) {
            $event = array($event);
        }
        Log::info('User registration successful', $event);
    }

    public function onUserRegistrationFailed($event) {
        if (!is_array($event)) {
            $event = array($event);
        }
        Log::notice('User registration failed', $event);
    }

    public function onUserActivationSuccessful($event) {
        if (!is_array($event)) {
            $event = array($event);
        }
        Log::info('User activation successful', $event);
    }

    public function onUserActivationFailed($event) {
        if (!is_array($event)) {
            $event = array($event);
        }
        Log::notice('User activation failed', $event);
    }
}
