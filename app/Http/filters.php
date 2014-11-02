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

use GrahamCampbell\Throttle\Facades\Throttle;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;

/*
|--------------------------------------------------------------------------
| Throttling Filters
|--------------------------------------------------------------------------
|
| This is where we check the user is not spamming our system by limiting
| certain types of actions with a throttler.
|
*/

$router->filter('throttle.comment', function ($route, $request) {
    // check if we've reached the rate limit, but don't hit the throttle yet
    // we can hit the throttle later on in the if validation passes
    if (!Throttle::check($request, 10, 1)) {
        throw new TooManyRequestsHttpException(60, 'Rate limit exceed.');
    }
});
