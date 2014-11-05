<?php

/**
 * This file is part of Laravel CloudFlare by Graham Campbell.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at http://bit.ly/UWsjkb.
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
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
