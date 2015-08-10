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
    | API Key
    |--------------------------------------------------------------------------
    |
    | This defines the api key to use to make calls to CloudFlare's API.
    |
    | Default to ''.
    |
    */

    'key' => '',

    /*
    |--------------------------------------------------------------------------
    | Email
    |--------------------------------------------------------------------------
    |
    | This defines the email address to use to make calls to CloudFlare's API.
    |
    | Default to ''.
    |
    */

    'email' => '',

    /*
    |--------------------------------------------------------------------------
    | Zone
    |--------------------------------------------------------------------------
    |
    | This defines the zone to read analytics information for.
    |
    | Default to ''.
    |
    */

    'zone' => '',

    /*
    |--------------------------------------------------------------------------
    | Cache Driver
    |--------------------------------------------------------------------------
    |
    | This defines the cache driver to be used. It may be the name of any
    | driver set in config/cache.php. Setting it to null will use the driver
    | you have set as default in config/cache.php.
    |
    | Default: null
    |
    */

    'cache' => null,

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
