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
    | Connection
    |--------------------------------------------------------------------------
    |
    | This defines the connection to use for api calls to CloudFlare. Set this
    | to null to use the default connection, or specify a connection name as
    | defined in your cloudflare-api config file.
    |
    | Default to null.
    |
    */

    'connection' => null,

    /*
    |--------------------------------------------------------------------------
    | Zone
    |--------------------------------------------------------------------------
    |
    | This defines the zone to use for api calls to CloudFlare.
    |
    | Default to 'example.com'.
    |
    */

    'zone' => 'example.com',

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

    'driver' => null,

    /*
    |--------------------------------------------------------------------------
    | Cache Key
    |--------------------------------------------------------------------------
    |
    | This defines the cache key to be used for storing the stats cache.
    |
    | Default: 'cloudflarestats'
    |
    */

    'key' => 'cloudflarestats',

];
