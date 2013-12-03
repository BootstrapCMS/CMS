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

use Config;
use Navigation;
Use Sentry;

class NavigationSubscriber {

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     * @return array
     */
    public function subscribe($events) {
        $events->listen('view.make', 'GrahamCampbell\BootstrapCMS\Subscribers\NavigationSubscriber@onViewMake');
    }

    /**
     * Handle a view.make event.
     *
     * @param  mixed  $event
     * @return void
     */
    public function onViewMake($event) {
        // add the blog
        if (Config::get('cms.blogging')) {
            Navigation::addItem('main', array('title' => 'Blog', 'slug' => 'blog/posts', 'icon' => 'book'));
        }
        // add the events
        if (Config::get('cms.events')) {
            Navigation::addItem('main', array('title' => 'Events', 'slug' => 'events', 'icon' => 'calendar'));
        }

        if ($event['User']) {
            // add the storage
            if (Config::get('cms.storage')) {
                Navigation::addItem('main', array('title' => 'Storage', 'slug' => 'storage/folders', 'icon' => 'folder-open'));
            }

            // add the profile links
            Navigation::addItem('bar', array('title' => 'View Profile', 'slug' => 'account/profile', 'icon' => 'cog'));
            // add the admin links
            if (Sentry::getUser()->hasAccess('admin')) {
                Navigation::addItem('bar', array('title' => 'View Logs', 'slug' => 'logviewer', 'icon' => 'wrench'));
                Navigation::addItem('bar', array('title' => 'Caching', 'slug' => 'caching', 'icon' => 'tachometer'));
                Navigation::addItem('bar', array('title' => 'CloudFlare', 'slug' => 'cloudflare', 'icon' => 'cloud'));
                Navigation::addItem('bar', array('title' => 'Queuing', 'slug' => 'queuing', 'icon' => 'random'));
            }
            // add the view users link
            if (Sentry::getUser()->hasAccess('mod')) {
                Navigation::addItem('bar', array('title' => 'View Users', 'slug' => 'users', 'icon' => 'user'));
            }
            // add the create user link
            if (Sentry::getUser()->hasAccess('admin')) {
                Navigation::addItem('bar', array('title' => 'Create User', 'slug' => 'users/create', 'icon' => 'star'));
            }
            // add the create page link
            if (Sentry::getUser()->hasAccess('edit')) {
                Navigation::addItem('bar', array('title' => 'Create Page', 'slug' => 'pages/create', 'icon' => 'pencil'));
            }
            // add the create post link
            if (Config::get('cms.blogging')) {
                if (Sentry::getUser()->hasAccess('blog')) {
                    Navigation::addItem('bar', array('title' => 'Create Post', 'slug' => 'blog/posts/create', 'icon' => 'book'));
                }
            }
            // add the create event link
            if (Config::get('cms.events')) {
                if (Sentry::getUser()->hasAccess('edit')) {
                    Navigation::addItem('bar', array('title' => 'Create Event', 'slug' => 'events/create', 'icon' => 'calendar'));
                }
            }

            // add the admin links
            if (Sentry::getUser()->hasAccess('admin')) {
                Navigation::addItem('admin', array('title' => 'Logs', 'slug' => 'logviewer', 'icon' => 'wrench'));
                Navigation::addItem('admin', array('title' => 'Caching', 'slug' => 'caching', 'icon' => 'tachometer'));
                Navigation::addItem('admin', array('title' => 'CloudFlare', 'slug' => 'cloudflare', 'icon' => 'cloud'));
                Navigation::addItem('admin', array('title' => 'Queuing', 'slug' => 'queuing', 'icon' => 'random'));
            }
            // add the view users link
            if (Sentry::getUser()->hasAccess('mod')) {
                Navigation::addItem('admin', array('title' => 'Users', 'slug' => 'users', 'icon' => 'user'));
            }
        }
    }
}
