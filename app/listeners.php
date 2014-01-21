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

/*
|--------------------------------------------------------------------------
| Application Event Listeners
|--------------------------------------------------------------------------
|
| Here is where you can register all of the listeners for an application.
|
*/

$subscriber = new GrahamCampbell\BootstrapCMS\Subscribers\CoreSubscriber;
Event::subscribe($subscriber);

$subscriber = new GrahamCampbell\BootstrapCMS\Subscribers\NavigationSubscriber;
Event::subscribe($subscriber);

$subscriber = new GrahamCampbell\BootstrapCMS\Subscribers\UserSubscriber;
Event::subscribe($subscriber);

$observer = new GrahamCampbell\BootstrapCMS\Observers\PageObserver;
Page::observe($observer);
