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
 *
 * @package    Bootstrap-CMS
 * @author     Graham Campbell
 * @license    GNU AFFERO GENERAL PUBLIC LICENSE
 * @copyright  Copyright (C) 2013  Graham Campbell
 * @link       https://github.com/GrahamCampbell/Bootstrap-CMS
 */

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request) {
    if (!$request->is('logviewer/*')) {
        Event::fire('page.load', array(array('URL' => Request::url(), 'Headers' => Request::header())));
    } else {
        $value = 'admin';

        if (!Sentry::check()) {
            Log::info('User tried to access a page without being logged in', array('path' => $request->path()));
            if (Request::ajax()) {
                return App::abort(401, 'Action Requires Login');
            }
            Session::flash('error', 'You must be logged in to perform that action.');
            return Redirect::guest(URL::route('account.login'));
        }

        if (!Sentry::getUser()->hasAccess($value)) {
            Log::warning('User tried to access a page without permission', array('path' => $request->path(), 'permission' => $value));
            return App::abort(403, ucwords($value).' Permissions Are Required');
        }
    }
});

App::after(function($request, $response) {
    //
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

// check if the user is logged in and their access level
Route::filter('auth', function($route, $request, $value) {
    if (!Sentry::check()) {
        Log::info('User tried to access a page without being logged in', array('path' => $request->path()));
        if (Request::ajax()) {
            return App::abort(401, 'Action Requires Login');
        }
        Session::flash('error', 'You must be logged in to perform that action.');
        return Redirect::guest(URL::route('account.login'));
    }

    if (!Sentry::getUser()->hasAccess($value)) {
        Log::warning('User tried to access a page without permission', array('path' => $request->path(), 'permission' => $value));
        return App::abort(403, ucwords($value).' Permissions Are Required');
    }
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function() {
    if (!Request::ajax() && Auth::check()) {
        return Redirect::intended(URL::route('pages.show', array('pages' => 'home')));
    }
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function() {
    if (Session::token() != Input::get('_token')) {
        throw new Illuminate\Session\TokenMismatchException;
    }
});
