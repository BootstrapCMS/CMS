<?php

/*
 * This file is part of Bootstrap CMS.
 *
 * (c) Graham Campbell <graham@mineuk.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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

$subscriber = App::make('GrahamCampbell\BootstrapCMS\Subscribers\CoreSubscriber');
Event::subscribe($subscriber);

$subscriber = App::make('GrahamCampbell\BootstrapCMS\Subscribers\NavigationSubscriber');
Event::subscribe($subscriber);

$observer = App::make('GrahamCampbell\BootstrapCMS\Observers\PageObserver');
PageProvider::observe($observer);
