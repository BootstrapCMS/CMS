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
| Application Event Listeners
|--------------------------------------------------------------------------
|
| Here is where you can register all of the listeners for an application.
| In this case I have loaded my subscribers here.
|
*/

$subscriber = new GrahamCampbell\BootstrapCMS\Subscribers\CoreSubscriber;
Event::subscribe($subscriber);

$subscriber = new GrahamCampbell\BootstrapCMS\Subscribers\EloquentSubscriber;
Event::subscribe($subscriber);

$subscriber = new GrahamCampbell\BootstrapCMS\Subscribers\PageSubscriber;
Event::subscribe($subscriber);

$subscriber = new GrahamCampbell\BootstrapCMS\Subscribers\UserSubscriber;
Event::subscribe($subscriber);
