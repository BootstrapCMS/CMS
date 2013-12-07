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
use PageProvider;
Use Sentry;

class NavigationSubscriber {

    /**
     * The user boolean.
     *
     * @var boolean
     */
    protected $user;

    /**
     * The home page.
     *
     * @var array
     */
    protected $home;

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     * @return array
     */
    public function subscribe($events) {
        $events->listen('view.make', 'GrahamCampbell\BootstrapCMS\Subscribers\NavigationSubscriber@onViewMake', 5);
        $events->listen('navigation.main', 'GrahamCampbell\BootstrapCMS\Subscribers\NavigationSubscriber@onNavigationMainFirst', 8);
        $events->listen('navigation.main', 'GrahamCampbell\BootstrapCMS\Subscribers\NavigationSubscriber@onNavigationMainSecond', 5);
        $events->listen('navigation.main', 'GrahamCampbell\BootstrapCMS\Subscribers\NavigationSubscriber@onNavigationMainThird', 2);
        $events->listen('navigation.bar', 'GrahamCampbell\BootstrapCMS\Subscribers\NavigationSubscriber@onNavigationBar', 2);
    }

    /**
     * Handle a view.make event.
     *
     * @param  mixed  $event
     * @return void
     */
    public function onViewMake($event) {
        $this->user = $event['User'];
    }

    /**
     * Handle a navigation.main event first.
     *
     * @param  mixed  $event
     * @return void
     */
    public function onNavigationMainFirst($event) {
        // add the blog
        if (Config::get('cms.blogging')) {
            Navigation::addMain('default', array('title' => 'Blog', 'slug' => 'blog/posts', 'icon' => 'book'));
        }

        // add the events
        if (Config::get('cms.events')) {
            Navigation::addMain('default', array('title' => 'Events', 'slug' => 'events', 'icon' => 'calendar'));
        }

        if ($this->user) {
            // add the storage
            if (Config::get('cms.storage')) {
                Navigation::addMain('default', array('title' => 'Storage', 'slug' => 'storage/folders', 'icon' => 'folder-open'));
            }

            // add the admin links
            if (Sentry::getUser()->hasAccess('admin')) {
                Navigation::addMain('admin', array('title' => 'Logs', 'slug' => 'logviewer', 'icon' => 'wrench'));
                Navigation::addMain('admin', array('title' => 'Caching', 'slug' => 'caching', 'icon' => 'tachometer'));
                Navigation::addMain('admin', array('title' => 'CloudFlare', 'slug' => 'cloudflare', 'icon' => 'cloud'));
                Navigation::addMain('admin', array('title' => 'Queuing', 'slug' => 'queuing', 'icon' => 'random'));
            }

            // add the view users link
            if (Sentry::getUser()->hasAccess('mod')) {
                Navigation::addMain('admin', array('title' => 'Users', 'slug' => 'users', 'icon' => 'user'));
            }
        }
    }

    /**
     * Handle a navigation.main event second.
     *
     * @param  mixed  $event
     * @return void
     */
    public function onNavigationMainSecond($event) {
        $pages = PageProvider::navigation();

        // separate the first page
        $this->home = $pages[0];
        unset($pages[0]);

        // add the pages to the nav bar
        foreach ($pages as $page) {
            // each page slug is preppended by 'pages/'
            $page['slug'] = 'pages/'.$page['slug'];
            // add each page to the main nav bar
            Navigation::addMain('default', $page);
        }
    }

    /**
     * Handle a navigation.main event second.
     *
     * @param  mixed  $event
     * @return void
     */
    public function onNavigationMainThird($event) {
        $home = $this->home;
        // make sure the home page is preppended by 'pages/'
        $home['slug'] = 'pages/'.$home['slug'];
        // add the home page to the start of the main nav bars
        Navigation::addMain('default', $page, true);
        Navigation::addMain('admin', $page, true);
    }

    /**
     * Handle a navigation.bar event.
     *
     * @param  mixed  $event
     * @return void
     */
    public function onNavigationBar($event) {
        if ($this->user) {
            // add the profile links
            Navigation::addBar('default', array('title' => 'View Profile', 'slug' => 'account/profile', 'icon' => 'cog'));

            // add the admin links
            if (Sentry::getUser()->hasAccess('admin')) {
                Navigation::addBar('default', array('title' => 'View Logs', 'slug' => 'logviewer', 'icon' => 'wrench'));
                Navigation::addBar('default', array('title' => 'Caching', 'slug' => 'caching', 'icon' => 'tachometer'));
                Navigation::addBar('default', array('title' => 'CloudFlare', 'slug' => 'cloudflare', 'icon' => 'cloud'));
                Navigation::addBar('default', array('title' => 'Queuing', 'slug' => 'queuing', 'icon' => 'random'));
            }

            // add the view users link
            if (Sentry::getUser()->hasAccess('mod')) {
                Navigation::addBar('default', array('title' => 'View Users', 'slug' => 'users', 'icon' => 'user'));
            }

            // add the create user link
            if (Sentry::getUser()->hasAccess('admin')) {
                Navigation::addBar('default', array('title' => 'Create User', 'slug' => 'users/create', 'icon' => 'star'));
            }

            // add the create page link
            if (Sentry::getUser()->hasAccess('edit')) {
                Navigation::addBar('default', array('title' => 'Create Page', 'slug' => 'pages/create', 'icon' => 'pencil'));
            }

            // add the create post link
            if (Config::get('cms.blogging')) {
                if (Sentry::getUser()->hasAccess('blog')) {
                    Navigation::addBar('default', array('title' => 'Create Post', 'slug' => 'blog/posts/create', 'icon' => 'book'));
                }
            }

            // add the create event link
            if (Config::get('cms.events')) {
                if (Sentry::getUser()->hasAccess('edit')) {
                    Navigation::addBar('default', array('title' => 'Create Event', 'slug' => 'events/create', 'icon' => 'calendar'));
                }
            }
        }
    }
}
