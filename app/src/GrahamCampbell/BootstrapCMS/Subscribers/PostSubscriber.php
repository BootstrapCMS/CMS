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

class PostSubscriber {

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     * @return array
     */
    public function subscribe($events) {
        $events->listen('post.created', 'GrahamCampbell\BootstrapCMS\Subscribers\PostSubscriber@onPostCreated');
        $events->listen('post.updated', 'GrahamCampbell\BootstrapCMS\Subscribers\PostSubscriber@onPostUpdated');
        $events->listen('post.deleted', 'GrahamCampbell\BootstrapCMS\Subscribers\PostSubscriber@onPostDeleted');
    }

    /**
     * Handle a post.created event.
     *
     * @param  mixed  $event
     * @return void
     */
    public function onPostCreated($event) {
        //
    }

    /**
     * Handle a post.updated event.
     *
     * @param  mixed  $event
     * @return void
     */
    public function onPostUpdated($event) {
        //
    }

    /**
     * Handle a post.deleted event.
     *
     * @param  mixed  $event
     * @return void
     */
    public function onPostDeleted($event) {
        //
    }
}
