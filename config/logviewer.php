<?php

/*
 * This file is part of Bootstrap CMS.
 *
 * (c) Graham Campbell <graham@alt-three.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Middleware
    |--------------------------------------------------------------------------
    |
    | This defines the middleware to be put in front of the endpoints provided
    | by this package. A common use will be for your own authentication
    | middleware.
    |
    | Default to [].
    |
    */

    'middleware' => ['GrahamCampbell\Credentials\Http\Middleware\Auth\Admin'],

    /*
    |--------------------------------------------------------------------------
    | Per Page
    |--------------------------------------------------------------------------
    |
    | This defines how many log entries are displayed per page.
    |
    | Default to 20.
    |
    */

    'per_page' => 20,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | This defines the layout to extend when building views.
    |
    | Default to 'layouts.default'.
    |
    */

    'layout' => 'layouts.default',

];
