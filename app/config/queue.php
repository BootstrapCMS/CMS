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

return array(

    /*
    |--------------------------------------------------------------------------
    | Default Queue Driver
    |--------------------------------------------------------------------------
    |
    | The Laravel queue API supports a variety of back-ends via an unified
    | API, giving you convenient access to each back-end using the same
    | syntax for each one. Here you may set the default queue driver.
    |
    | Supported: "sync", "beanstalkd", "sqs", "iron"
    |
    */

    'default' => 'sync',

    /*
    |--------------------------------------------------------------------------
    | Queue Connections
    |--------------------------------------------------------------------------
    |
    | Here you may configure the connection information for each server that
    | is used by your application. A default configuration has been added
    | for each back-end shipped with Laravel. You are free to add more.
    |
    | Please read the Bootstrap CMS documentation on GitHub for more details.
    |
    */

    'connections' => array(

        'sync' => array(
            'driver' => 'sync'
        ),

        'beanstalkd' => array(
            'driver' => 'beanstalkd',
            'host'   => 'localhost',
            'queue'  => 'bootstrap-cms-jobs',
            'mail'   => 'bootstrap-cms-mail',
            'cron'   => 'bootstrap-cms-cron'
        ),

        'sqs' => array(
            'driver' => 'sqs',
            'key'    => 'your-public-key',
            'secret' => 'your-secret-key',
            'region' => 'us-east-1',
            'queue'  => 'bootstrap-cms-jobs',
            'mail'   => 'bootstrap-cms-mail',
            'cron'   => 'bootstrap-cms-cron'
        ),

        'iron' => array(
            'driver'  => 'iron',
            'project' => 'your-project-id',
            'token'   => 'your-token',
            'queue'   => 'bootstrap-cms-jobs',
            'mail'    => 'bootstrap-cms-mail',
            'cron'    => 'bootstrap-cms-cron'
        )

    )

);
