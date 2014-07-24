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

use Illuminate\Session\TokenMismatchException;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;

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

App::before(function ($request) {
    Event::fire('page.load', array(array('Path' => $request->path(), 'Headers' => $request->header())));
});

App::after(function ($request, $response) {
    //
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

Route::filter('csrf', function () {
    if (Session::token() != Input::get('_token')) {
        throw new TokenMismatchException;
    }
});


/*
|--------------------------------------------------------------------------
| Throttling Filters
|--------------------------------------------------------------------------
|
| This is where we check the user is not spamming our system by limiting
| certain types of actions with a throttler.
|
*/

Route::filter('throttle.comment', function ($route, $request) {
    // check if we've reached the rate limit, but don't hit the throttle yet
    // we can hit the throttle later on in the if validation passes
    if (!Throttle::check($request, 10, 1)) {
        throw new TooManyRequestsHttpException(60, 'Rate limit exceed.');
    }
});
