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

/*
|--------------------------------------------------------------------------
| Register The Artisan Commands
|--------------------------------------------------------------------------
|
| Each available Artisan command must be registered with the console so
| that it is available to be called. We'll register every command so
| the console gets access to each of the command object instances.
|
*/

Artisan::add(new GrahamCampbell\BootstrapCMS\Commands\AppUpdate);

Artisan::add(new GrahamCampbell\BootstrapCMS\Commands\AppInstall);

Artisan::add(new GrahamCampbell\BootstrapCMS\Commands\AppReset);

Artisan::add(new GrahamCampbell\BootstrapCMS\Commands\QueueLength);

Artisan::add(new GrahamCampbell\BootstrapCMS\Commands\QueueClear);

Artisan::add(new GrahamCampbell\BootstrapCMS\Commands\QueueIron);

Artisan::add(new GrahamCampbell\BootstrapCMS\Commands\QueueDos);

Artisan::add(new GrahamCampbell\BootstrapCMS\Commands\CronStart);

Artisan::add(new GrahamCampbell\BootstrapCMS\Commands\CronStop);
