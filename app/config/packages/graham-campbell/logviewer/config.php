<?php

/*
 * This file is part of Laravel LogViewer.
 *
 * (c) Graham Campbell <graham@mineuk.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Filters
    |--------------------------------------------------------------------------
    |
    | This defines the filters to be put in front of the endpoints provided by
    | this package. A common use will be for your own authentication filters.
    |
    | Default to array().
    |
    */

    'filters' => ['credentials:admin'],

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

];
