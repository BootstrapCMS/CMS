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
    | View Storage Paths
    |--------------------------------------------------------------------------
    |
    | Most templating systems load templates from disk. Here you may specify
    | an array of paths that should be checked for your views. Of course
    | the usual Laravel view path has already been registered for you.
    |
    */

    'paths' => array(__DIR__.'/../views'),

    /*
    |--------------------------------------------------------------------------
    | Pagination View
    |--------------------------------------------------------------------------
    |
    | This view will be used to render the pagination link output, and can
    | be easily customized here to show any view you like. A clean view
    | compatible with Twitter's Bootstrap is given to you by default.
    |
    */

    'pagination' => 'pagination::slider-3',

);
