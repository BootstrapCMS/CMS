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
    | CSS Theme
    |--------------------------------------------------------------------------
    |
    | This defines what theme of Bootstrap to use from bootswatch.com.
    |
    | After making theme changes, you will have to run php artisan app:update.
    |
    | Supported: "cerulean", "cosmo", "cyborg", "darkly", "default", "flatly",
    |            "journal", "legacy", "lumen", "paper", "readable", "sandstone",
    |            "simplex", "slate", "spacelab", "superhero", "united", "yeti"
    |
    | Default to 'default'.
    |
    */

    'name' => env('THEME_NAME', 'default'),

    /*
    |--------------------------------------------------------------------------
    | Use Inverse Nav Bar
    |--------------------------------------------------------------------------
    |
    | This defines if the nav bar is inverse.
    |
    | When this is enabled, the "navbar-inverse" class will be used in the
    | navigation bar on all pages.
    |
    | Default to true.
    |
    */

    'inverse' => env('THEME_INVERSE', true),

];
