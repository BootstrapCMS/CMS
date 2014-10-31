<?php
/**
 * Part of the Sentry package.
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the 3-clause BSD License.
 *
 * This source file is subject to the 3-clause BSD License that is
 * bundled with this package in the LICENSE file.  It is also available at
 * the following URL: http://www.opensource.org/licenses/BSD-3-Clause
 *
 * @package    Sentry
 * @author     Cartalyst LLC
 * @license    BSD License (3-clause)
 * @copyright  (c) 2011 - 2013, Cartalyst LLC
 * @link       http://cartalyst.com
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Default Authentication Driver
    |--------------------------------------------------------------------------
    |
    | This option controls the authentication driver that will be utilized.
    | This drivers manages the retrieval and authentication of the users
    | attempting to get access to protected areas of your application.
    |
    | Supported: "eloquent" (more coming soon).
    |
    */

    'driver' => 'eloquent',

    /*
    |--------------------------------------------------------------------------
    | Default Hasher
    |--------------------------------------------------------------------------
    |
    | This option allows you to specify the default hasher used by Sentry
    |
    | Supported: "native", "bcrypt", "sha256", "whirlpool"
    |
    */

    'hasher' => 'native',

    /*
    |--------------------------------------------------------------------------
    | Cookie
    |--------------------------------------------------------------------------
    |
    | Configuration specific to the cookie component of Sentry.
    |
    */

    'cookie' => [

        /*
        |--------------------------------------------------------------------------
        | Default Cookie Key
        |--------------------------------------------------------------------------
        |
        | This option allows you to specify the default cookie key used by Sentry.
        |
        | Supported: string
        |
        */

        'key' => 'cartalyst_sentry',

    ],

    /*
    |--------------------------------------------------------------------------
    | Groups
    |--------------------------------------------------------------------------
    |
    | Configuration specific to the group management component of Sentry.
    |
    */

    'groups' => [

        /*
        |--------------------------------------------------------------------------
        | Model
        |--------------------------------------------------------------------------
        |
        | When using the "eloquent" driver, we need to know which
        | Eloquent models should be used throughout Sentry.
        |
        */

        'model' => 'GrahamCampbell\Credentials\Models\Group',

    ],

    /*
    |--------------------------------------------------------------------------
    | Users
    |--------------------------------------------------------------------------
    |
    | Configuration specific to the user management component of Sentry.
    |
    */

    'users' => [

        /*
        |--------------------------------------------------------------------------
        | Model
        |--------------------------------------------------------------------------
        |
        | When using the "eloquent" driver, we need to know which
        | Eloquent models should be used throughout Sentry.
        |
        */

        'model' => 'GrahamCampbell\BootstrapCMS\Models\User',

        /*
        |--------------------------------------------------------------------------
        | Login Attribute
        |--------------------------------------------------------------------------
        |
        | If you're the "eloquent" driver and extending the base Eloquent model,
        | we allow you to globally override the login attribute without even
        | subclassing the model, simply by specifying the attribute below.
        |
        */

        'login_attribute' => 'email',

    ],

    /*
    |--------------------------------------------------------------------------
    | Throttling
    |--------------------------------------------------------------------------
    |
    | Throttling is an optional security feature for authentication, which
    | enables limiting of login attempts and the suspension & banning of users.
    |
    */

    'throttling' => [

        /*
        |--------------------------------------------------------------------------
        | Throttling
        |--------------------------------------------------------------------------
        |
        | Enable throttling or not. Throttling is where users are only allowed a
        | certain number of login attempts before they are suspended. Suspension
        | must be removed before a new login attempt is allowed.
        |
        */

        'enabled' => true,

        /*
        |--------------------------------------------------------------------------
        | Model
        |--------------------------------------------------------------------------
        |
        | When using the "eloquent" driver, we need to know which
        | Eloquent models should be used throughout Sentry.
        |
        */

        'model' => 'GrahamCampbell\Credentials\Models\Throttle',

        /*
        |--------------------------------------------------------------------------
        | Attempts Limit
        |--------------------------------------------------------------------------
        |
        | When using the "eloquent" driver and extending the base Eloquent model,
        | you have the option to globally set the login attempts.
        |
        | Supported: int
        |
        */

        'attempt_limit' => 5,

        /*
        |--------------------------------------------------------------------------
        | Suspension Time
        |--------------------------------------------------------------------------
        |
        | When using the "eloquent" driver and extending the base Eloquent model,
        | you have the option to globally set the suspension time, in minutes.
        |
        | Supported: int
        |
        */

        'suspension_time' => 15,

    ],

];
