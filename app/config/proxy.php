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
    | Trusted Proxies
    |--------------------------------------------------------------------------
    |
    | Set an array of trusted proxies, so Laravel knows to grab the client's
    | IP address via the HTTP_X_FORWARDED_FOR header.
    |
    | By default, we are trusting Cloudflare only.
    |
    | To trust all proxies, use the value '*':
    |
    | 'proxies' => '*'
    |
    */

    'proxies' => array(

        '204.93.240.0',
        '204.93.177.0',
        '199.27.128.0',
        '173.245.48.0',
        '103.21.244.0',
        '103.22.200.0',
        '103.31.4.0',
        '141.101.64.0',
        '108.162.192.0',
        '190.93.240.0',
        '188.114.96.0',
        '197.234.240.0',
        '198.41.128.0',
        '162.158.0.0',
        '2400:cb00::',
        '2606:4700::',
        '2803:f800::',
        '2405:b500::',
        '2405:8100::',

    ),

);
