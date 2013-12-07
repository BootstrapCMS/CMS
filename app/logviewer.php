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
 *
 * @package    Bootstrap-CMS
 * @author     Graham Campbell
 * @license    GNU AFFERO GENERAL PUBLIC LICENSE
 * @copyright  Copyright (C) 2013  Graham Campbell
 * @link       https://github.com/GrahamCampbell/Bootstrap-CMS
 */

use Carbon\Carbon;
use Kmd\Logviewer\Logviewer;
use Illuminate\Pagination\Environment;

/*
|--------------------------------------------------------------------------
| Logviewer Routes
|--------------------------------------------------------------------------
|
| Here is where the logviewer routes have been overwritten.
|
*/


$filters = Config::get('logviewer::filters.global');

if (isset($filters['before'])) {
    if (!is_array($filters['before'])) {
        $filters['before'] = explode('|', $filters['before']);
    }
} else {
    $filters['before'] = array();
}

$filters['before'][] = 'logviewer.messages';

if (isset($filters['after'])) {
    if (!is_array($filters['after'])) {
        $filters['after'] = explode('|', $filters['after']);
    }
} else {
    $filters['after'] = array();
}

Route::group(array('before' => $filters['before'], 'after' => $filters['after']), function () {
    Route::get(Config::get('logviewer::base_url'), array('as' => 'logviewer.main', 'uses' => 'GrahamCampbell\BootstrapCMS\Controllers\LogController@getMain'));

    $filters = Config::get('logviewer::filters.delete');

    if (isset($filters['before'])) {
        if (!is_array($filters['before'])) {
            $filters['before'] = explode('|', $filters['before']);
        }
    } else {
        $filters['before'] = array();
    }

    if (isset($filters['after'])) {
        if (!is_array($filters['after'])) {
            $filters['after'] = explode('|', $filters['after']);
        }
    } else {
        $filters['after'] = array();
    }

    Route::group(array('before' => $filters['before'], 'after' => $filters['after']), function () {
        Route::get(Config::get('logviewer::base_url').'/{path}/{sapi}/{date}/delete', array('as' => 'logviewer.delete', 'uses' => 'GrahamCampbell\BootstrapCMS\Controllers\LogController@getDelete'));
    });

    $filters = Config::get('logviewer::filters.view');

    if (isset($filters['before'])) {
        if (!is_array($filters['before'])) {
            $filters['before'] = explode('|', $filters['before']);
        }
    } else {
        $filters['before'] = array();
    }

    $filters['before'][] = 'logviewer.logs';

    if (isset($filters['after'])) {
        if (!is_array($filters['after'])) {
            $filters['after'] = explode('|', $filters['after']);
        }
    } else {
        $filters['after'] = array();
    }

    Route::group(array('before' => $filters['before'], 'after' => $filters['after']), function () {
        Route::get(Config::get('logviewer::base_url').'/{path}/{sapi}/{date}/{level?}', array('as' => 'logviewer.show', 'uses' => 'GrahamCampbell\BootstrapCMS\Controllers\LogController@getShow'));
    });
});
