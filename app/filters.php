<?php

/*
 * This file is part of Bootstrap CMS.
 *
 * (c) Graham Campbell <graham@mineuk.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
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
    Event::fire('page.load', [['Path' => $request->path(), 'Headers' => $request->header()]]);
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
    if (Session::token() !== Input::get('_token')) {
        throw new TokenMismatchException();
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
