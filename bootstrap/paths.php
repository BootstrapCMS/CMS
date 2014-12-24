<?php

/*
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
    | Application Path
    |--------------------------------------------------------------------------
    |
    | Here we just defined the path to the application directory. Most likely
    | you will never need to change this value as the default setup should
    | work perfectly fine for the vast majority of all our applications.
    |
    */

    'app' => __DIR__.'/../app',

    /*
    |--------------------------------------------------------------------------
    | Public Path
    |--------------------------------------------------------------------------
    |
    | The public path contains the assets for your web application, such as
    | your JavaScript and CSS files, and also contains the primary entry
    | point for web requests into these applications from the outside.
    |
    */

    'public' => __DIR__.'/../public',

    /*
    |--------------------------------------------------------------------------
    | Base Path
    |--------------------------------------------------------------------------
    |
    | The base path is the root of the Laravel installation. Most likely you
    | will not need to change this value. But, if for some wild reason it
    | is necessary you will do so here, just proceed with some caution.
    |
    */

    'base' => __DIR__.'/..',

    /*
    |--------------------------------------------------------------------------
    | Storage Path
    |--------------------------------------------------------------------------
    |
    | The storage path is used by Laravel to store cached Blade views, logs
    | and other pieces of information. You may modify the path here when
    | you want to change the location of this directory for your apps.
    |
    */

    'storage' => __DIR__.'/../app/storage',

];
