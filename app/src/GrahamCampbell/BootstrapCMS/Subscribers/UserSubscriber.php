<?php namespace GrahamCampbell\BootstrapCMS\Subscribers;

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

class UserSubscriber {

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     * @return array
     */
    public function subscribe($events) {
        $events->listen('user.created', 'GrahamCampbell\BootstrapCMS\Subscribers\UserSubscriber@onUserCreated');
        $events->listen('user.updated', 'GrahamCampbell\BootstrapCMS\Subscribers\UserSubscriber@onUserUpdated');
        $events->listen('user.deleted', 'GrahamCampbell\BootstrapCMS\Subscribers\UserSubscriber@onUserDeleted');
    }

    /**
     * Handle a user.created event.
     *
     * @param  mixed  $event
     * @return void
     */
    public function onUserCreated($event) {
        //
    }

    /**
     * Handle a user.updated event.
     *
     * @param  mixed  $event
     * @return void
     */
    public function onUserUpdated($event) {
        //
    }

    /**
     * Handle a user.deleted event.
     *
     * @param  mixed  $event
     * @return void
     */
    public function onUserDeleted($event) {
        //
    }
}
