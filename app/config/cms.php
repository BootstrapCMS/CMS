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

return array(

    /*
    |--------------------------------------------------------------------------
    | Enable Blogging
    |--------------------------------------------------------------------------
    |
    | This defines if the blog functionality is enabled.
    |
    | Disabling it will not delete anything from your database, it will just
    | inaccessible from the web. All associated routes will not be registered,
    | and the navigation bar will not show any associated links.
    |
    | Default to true.
    |
    */

    'blogging' => true,

    /*
    |--------------------------------------------------------------------------
    | Comment Fetch Interval
    |--------------------------------------------------------------------------
    |
    | This defines the minimum time interval for a client's browser to check
    | for new comments on a blog post in milliseconds.
    |
    | Default to 5000.
    |
    */

    'commentfetch' => 5000,


    /*
    |--------------------------------------------------------------------------
    | Comment Transition Time
    |--------------------------------------------------------------------------
    |
    | This defines how long comment transitions take to complete in
    | milliseconds. It must be a number divisible by 2.
    |
    | Default to 300.
    |
    */

    'commenttrans' => 300,

    /*
    |--------------------------------------------------------------------------
    | Enable Events
    |--------------------------------------------------------------------------
    |
    | This defines if the event functionality is enabled.
    |
    | Disabling it will not delete anything from your database, it will just
    | inaccessible from the web. All associated routes will not be registered,
    | and the navigation bar will not show any associated links.
    |
    | Default to true.
    |
    */

    'events' => true,

    /*
    |--------------------------------------------------------------------------
    | Enable File Storage
    |--------------------------------------------------------------------------
    |
    | This defines if the file storage functionality is enabled.
    |
    | Disabling it will not delete anything from your database, it will just
    | inaccessible from the web. All associated routes will not be registered,
    | and the navigation bar will not show any associated links.
    |
    | Default to true.
    |
    */

    'storage' => true

);
