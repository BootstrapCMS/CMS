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

namespace GrahamCampbell\BootstrapCMS\Subscribers;

use GrahamCampbell\CMSCore\Facades\PageProvider;

/**
 * This is the page subscriber class.
 *
 * @package    Bootstrap-CMS
 * @author     Graham Campbell
 * @copyright  Copyright (C) 2013  Graham Campbell
 * @license    https://github.com/GrahamCampbell/Bootstrap-CMS/blob/develop/LICENSE.md
 * @link       https://github.com/GrahamCampbell/Bootstrap-CMS
 */
class PageSubscriber
{
    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     * @return array
     */
    public function subscribe($events)
    {
        $events->listen('page.created', 'GrahamCampbell\BootstrapCMS\Subscribers\PageSubscriber@onPageCreated', 5);
        $events->listen('page.updated', 'GrahamCampbell\BootstrapCMS\Subscribers\PageSubscriber@onPageUpdated', 5);
        $events->listen('page.deleted', 'GrahamCampbell\BootstrapCMS\Subscribers\PageSubscriber@onPageDeleted', 5);
    }

    /**
     * Handle a page.created event.
     *
     * @param  mixed  $event
     * @return void
     */
    public function onPageCreated($event)
    {
        // refresh the navigation cache
        PageProvider::refresh();
    }

    /**
     * Handle a page.updated event.
     *
     * @param  mixed  $event
     * @return void
     */
    public function onPageUpdated($event)
    {
        // refresh the navigation cache
        PageProvider::refresh();
    }

    /**
     * Handle a page.deleted event.
     *
     * @param  mixed  $event
     * @return void
     */
    public function onPageDeleted($event)
    {
        // refresh the navigation cache
        PageProvider::refresh();
    }
}
