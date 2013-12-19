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

use Illuminate\Support\Facades\Config;
use Cartalyst\Sentry\Facades\Laravel\Sentry;
use GrahamCampbell\CMSCore\Facades\PageProvider;
use GrahamCampbell\Navigation\Facades\Navigation;

/**
 * This is the navigation subscriber class.
 *
 * @package    Bootstrap-CMS
 * @author     Graham Campbell
 * @copyright  Copyright (C) 2013  Graham Campbell
 * @license    https://github.com/GrahamCampbell/Bootstrap-CMS/blob/develop/LICENSE.md
 * @link       https://github.com/GrahamCampbell/Bootstrap-CMS
 */
class NavigationSubscriber
{
    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     * @return array
     */
    public function subscribe($events)
    {
        $events->listen('navigation.main', 'GrahamCampbell\BootstrapCMS\Subscribers\NavigationSubscriber@onNavigationMainFirst', 8);
        $events->listen('navigation.main', 'GrahamCampbell\BootstrapCMS\Subscribers\NavigationSubscriber@onNavigationMainSecond', 5);
        $events->listen('navigation.main', 'GrahamCampbell\BootstrapCMS\Subscribers\NavigationSubscriber@onNavigationMainThird', 2);
        $events->listen('navigation.bar', 'GrahamCampbell\BootstrapCMS\Subscribers\NavigationSubscriber@onNavigationBarFirst', 8);
        $events->listen('navigation.bar', 'GrahamCampbell\BootstrapCMS\Subscribers\NavigationSubscriber@onNavigationBarSecond', 5);
        $events->listen('navigation.bar', 'GrahamCampbell\BootstrapCMS\Subscribers\NavigationSubscriber@onNavigationBarThird', 2);
    }

    /**
     * Handle a navigation.main event first.
     *
     * @param  mixed  $event
     * @return void
     */
    public function onNavigationMainFirst($event)
    {
        // add the blog
        if (Config::get('cms.blogging')) {
            Navigation::addMain(array('title' => 'Blog', 'slug' => 'blog/posts', 'icon' => 'book'));
        }

        // add the events
        if (Config::get('cms.events')) {
            Navigation::addMain(array('title' => 'Events', 'slug' => 'events', 'icon' => 'calendar'));
        }

        if (PageProvider::getNavUser()) {
            // add the storage
            if (Config::get('cms.storage')) {
                Navigation::addMain(array('title' => 'Storage', 'slug' => 'storage/folders', 'icon' => 'folder-open'));
            }
        }
    }

    /**
     * Handle a navigation.main event second.
     *
     * @param  mixed  $event
     * @return void
     */
    public function onNavigationMainSecond($event)
    {
        // get the pages
        $pages = PageProvider::navigation();

        // delete the home page
        unset($pages[0]);

        // add the pages to the nav bar
        foreach ($pages as $page) {
            // make sure the page is preppended by 'pages/'
            $page['slug'] = 'pages/'.$page['slug'];
            // add the page to the main nav bar
            Navigation::addMain($page);
        }

        if (PageProvider::getNavUser()) {
            // add the admin links
            if (Sentry::getUser()->hasAccess('admin')) {
                Navigation::addMain(array('title' => 'Caching', 'slug' => 'caching', 'icon' => 'tachometer'), 'admin');
                Navigation::addMain(array('title' => 'Queuing', 'slug' => 'queuing', 'icon' => 'random'), 'admin');
            }
        }
    }

    /**
     * Handle a navigation.main event second.
     *
     * @param  mixed  $event
     * @return void
     */
    public function onNavigationMainThird($event)
    {
        // get the pages
        $pages = PageProvider::navigation();

        // select the home page
        $page = $pages[0];

        // make sure the page is preppended by 'pages/'
        $page['slug'] = 'pages/'.$page['slug'];
        // add the page to the start of the main nav bars
        Navigation::addMain($page, 'default', true);
        Navigation::addMain($page, 'admin', true);

        if (PageProvider::getNavUser()) {
            // add the view users link
            if (Sentry::getUser()->hasAccess('mod')) {
                Navigation::addMain(array('title' => 'Users', 'slug' => 'users', 'icon' => 'user'), 'admin');
            }
        }
    }

    /**
     * Handle a navigation.bar event first.
     *
     * @param  mixed  $event
     * @return void
     */
    public function onNavigationBarFirst($event)
    {
        if (PageProvider::getNavUser()) {
            // add the profile links
            Navigation::addBar(array('title' => 'View Profile', 'slug' => 'account/profile', 'icon' => 'cog'));
        }
    }

    /**
     * Handle a navigation.bar event second.
     *
     * @param  mixed  $event
     * @return void
     */
    public function onNavigationBarSecond($event)
    {
        if (PageProvider::getNavUser()) {
            // add the admin links
            if (Sentry::getUser()->hasAccess('admin')) {
                Navigation::addBar(array('title' => 'Caching', 'slug' => 'caching', 'icon' => 'tachometer'));
                Navigation::addBar(array('title' => 'Queuing', 'slug' => 'queuing', 'icon' => 'random'));
            }
        }
    }

    /**
     * Handle a navigation.bar event third.
     *
     * @param  mixed  $event
     * @return void
     */
    public function onNavigationBarThird($event)
    {
        if (PageProvider::getNavUser()) {
            // add the view users link
            if (Sentry::getUser()->hasAccess('mod')) {
                Navigation::addBar(array('title' => 'View Users', 'slug' => 'users', 'icon' => 'user'));
            }

            // add the create user link
            if (Sentry::getUser()->hasAccess('admin')) {
                Navigation::addBar(array('title' => 'Create User', 'slug' => 'users/create', 'icon' => 'star'));
            }

            // add the create page link
            if (Sentry::getUser()->hasAccess('edit')) {
                Navigation::addBar(array('title' => 'Create Page', 'slug' => 'pages/create', 'icon' => 'pencil'));
            }

            // add the create post link
            if (Config::get('cms.blogging')) {
                if (Sentry::getUser()->hasAccess('blog')) {
                    Navigation::addBar(array('title' => 'Create Post', 'slug' => 'blog/posts/create', 'icon' => 'book'));
                }
            }

            // add the create event link
            if (Config::get('cms.events')) {
                if (Sentry::getUser()->hasAccess('edit')) {
                    Navigation::addBar(array('title' => 'Create Event', 'slug' => 'events/create', 'icon' => 'calendar'));
                }
            }
        }
    }
}
