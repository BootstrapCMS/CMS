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

use GrahamCampbell\BootstrapCMS\Facades\PageRepository;

/*
|--------------------------------------------------------------------------
| Application Event Listeners
|--------------------------------------------------------------------------
|
| Here is where you can register all of the listeners for an application.
|
*/

if (Config::get('graham-campbell/core::commands')) {
    $subscriber = App::make('GrahamCampbell\BootstrapCMS\Subscribers\CommandSubscriber');
    Event::subscribe($subscriber);
}

$subscriber = App::make('GrahamCampbell\BootstrapCMS\Subscribers\NavigationSubscriber');
Event::subscribe($subscriber);

$observer = App::make('GrahamCampbell\BootstrapCMS\Observers\PageObserver');
PageRepository::observe($observer);
