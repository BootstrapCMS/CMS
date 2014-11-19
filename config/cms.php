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

return [

    /*
    |--------------------------------------------------------------------------
    | Site Description
    |--------------------------------------------------------------------------
    |
    | This defines the site author.
    |
    | Default to 'Bootstrap CMS is a PHP CMS powered by Laravel 5.'.
    |
    */

    'description' => 'Bootstrap CMS is a PHP CMS powered by Laravel 5.',

    /*
    |--------------------------------------------------------------------------
    | Site Author
    |--------------------------------------------------------------------------
    |
    | This defines the site author.
    |
    | Default to 'Graham Campbell'.
    |
    */

    'author' => 'Graham Campbell',

    /*
    |--------------------------------------------------------------------------
    | Navigation Text
    |--------------------------------------------------------------------------
    |
    | This defines property from the user model to use on the navigation bar.
    |
    | This could be: 'email', 'name', 'first_name', 'last_name'
    |
    | Default to 'email'.
    |
    */

    'nav' => 'email',

    /*
    |--------------------------------------------------------------------------
    | Enable Eval On Pages
    |--------------------------------------------------------------------------
    |
    | This defines if the page eval functionality is enabled.
    |
    | Disabling it will prevent people from executing php on pages. This would
    | be useful if you wanted to prevent users writing dynamic pages, because
    | allowing them to execute php means they can do anything really.
    |
    | Default to true.
    |
    */

    'eval' => true,

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
    | Comment Model
    |--------------------------------------------------------------------------
    |
    | This defines the comment model to be used.
    |
    | Default: 'GrahamCampbell\BootstrapCMS\Models\Comment'
    |
    */

    'comment' => 'GrahamCampbell\BootstrapCMS\Models\Comment',

    /*
    |--------------------------------------------------------------------------
    | Event Model
    |--------------------------------------------------------------------------
    |
    | This defines the event model to be used.
    |
    | Default: 'GrahamCampbell\BootstrapCMS\Models\Event'
    |
    */

    'event' => 'GrahamCampbell\BootstrapCMS\Models\Event',

    /*
    |--------------------------------------------------------------------------
    | Page Model
    |--------------------------------------------------------------------------
    |
    | This defines the page model to be used.
    |
    | Default: 'GrahamCampbell\BootstrapCMS\Models\Page'
    |
    */

    'page' => 'GrahamCampbell\BootstrapCMS\Models\Page',

    /*
    |--------------------------------------------------------------------------
    | Post Model
    |--------------------------------------------------------------------------
    |
    | This defines the post model to be used.
    |
    | Default: 'GrahamCampbell\BootstrapCMS\Models\Post'
    |
    */

    'post' => 'GrahamCampbell\BootstrapCMS\Models\Post',

];
