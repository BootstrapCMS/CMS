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
use Log;
use Navigation;
Use Sentry;

class CoreSubscriber {

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     * @return array
     */
    public function subscribe($events) {
        $events->listen('page.load', 'GrahamCampbell\BootstrapCMS\Subscribers\CoreSubscriber@onPageLoad');
        $events->listen('view.make', 'GrahamCampbell\BootstrapCMS\Subscribers\CoreSubscriber@onViewMake');
        $events->listen('artisan.start', 'GrahamCampbell\BootstrapCMS\Subscribers\CoreSubscriber@onArtisanStart');
        $events->listen('illuminate.query', 'GrahamCampbell\BootstrapCMS\Subscribers\CoreSubscriber@onIlluminateQuery');
        $events->listen('locale.changed', 'GrahamCampbell\BootstrapCMS\Subscribers\CoreSubscriber@onLocaleChanged');
    }

    /**
     * Handle a page.load event.
     *
     * @param  mixed  $event
     * @return void
     */
    public function onPageLoad($event) {
        if (Config::get('log.pageload') == true) {
            if (!is_array($event)) {
                $event = array($event);
            }
            Log::debug('Page Loading', $event);
        }
    }

    /**
     * Handle a view.make event.
     *
     * @param  mixed  $event
     * @return void
     */
    public function onViewMake($event) {
        if (Config::get('log.viewmake') == true) {
            if (!is_array($event)) {
                $event = array($event);
            }
            Log::debug('View Created', $event);
        }

        // add the blog page after the fist page if blogging is enabled
        if (Config::get('cms.blogging')) {
            Navigation::addItem('main', array('title' => 'Blog', 'slug' => 'blog/posts', 'icon' => 'fa fa-book'));
        }
        // add the events page after the fist page if events are enabled
        if (Config::get('cms.events')) {
            Navigation::addItem('main', array('title' => 'Events', 'slug' => 'events', 'icon' => 'fa fa-calendar'));
        }

        if ($event['User']) {
            // add the profile links
            Navigation::addItem('bar', array('title' => 'View Profile', 'slug' => 'account/profile', 'icon' => 'fa fa-cog'));
            // add the admin links
            if (Sentry::getUser()->hasAccess('admin')) {
                Navigation::addItem('bar', array('title' => 'View Logs', 'slug' => 'logviewer', 'icon' => 'fa fa-wrench'));
                Navigation::addItem('bar', array('title' => 'Caching', 'slug' => 'caching', 'icon' => 'fa fa-tachometer'));
                Navigation::addItem('bar', array('title' => 'CloudFlare', 'slug' => 'cloudflare', 'icon' => 'fa fa-cloud'));
            }
            // add the view users link
            if (Sentry::getUser()->hasAccess('mod')) {
                Navigation::addItem('bar', array('title' => 'View Users', 'slug' => 'users', 'icon' => 'fa fa-user'));
            }
            // add the create user link
            if (Sentry::getUser()->hasAccess('admin')) {
                Navigation::addItem('bar', array('title' => 'Create User', 'slug' => 'users/create', 'icon' => 'fa fa-star'));
            }
            // add the create page link
            if (Sentry::getUser()->hasAccess('edit')) {
                Navigation::addItem('bar', array('title' => 'Create Page', 'slug' => 'pages/create', 'icon' => 'fa fa-pencil'));
            }
            // add the create post link
            if (Config::get('cms.blogging')) {
                if (Sentry::getUser()->hasAccess('blog')) {
                    Navigation::addItem('bar', array('title' => 'Create Post', 'slug' => 'blog/posts/create', 'icon' => 'fa fa-book'));
                }
            }
            // add the create event link
            if (Config::get('cms.events')) {
                if (Sentry::getUser()->hasAccess('edit')) {
                    Navigation::addItem('bar', array('title' => 'Create Event', 'slug' => 'events/create', 'icon' => 'fa fa-calendar'));
                }
            }

            // add the admin links
            if (Sentry::getUser()->hasAccess('admin')) {
                Navigation::addItem('admin', array('title' => 'Logs', 'slug' => 'logviewer', 'icon' => 'fa fa-wrench'));
                Navigation::addItem('admin', array('title' => 'Caching', 'slug' => 'caching', 'icon' => 'fa fa-tachometer'));
                Navigation::addItem('admin', array('title' => 'CloudFlare', 'slug' => 'cloudflare', 'icon' => 'fa fa-cloud'));
            }
            // add the view users link
            if (Sentry::getUser()->hasAccess('mod')) {
                Navigation::addItem('admin', array('title' => 'Users', 'slug' => 'users', 'icon' => 'fa fa-user'));
            }
        }
    }

    /**
     * Handle an artisan.start event.
     *
     * @param  mixed  $event
     * @return void
     */
    public function onArtisanStart($event) {
        if (Config::get('log.artisanstart') == true) {
            if (!is_array($event)) {
                $event = array($event);
            }
            Log::debug('Artisan Starting', $event);
        }
    }

    /**
     * Handle a illuminate.query event.
     *
     * @param  mixed  $event
     * @return void
     */
    public function onIlluminateQuery($event) {
        if (Config::get('log.illuminatequery') == true) {
            if (!is_array($event)) {
                $event = array($event);
            }
            Log::debug('Query Executed', $event);
        }
    }

    /**
     * Handle a locale.changed event.
     *
     * @param  mixed  $event
     * @return void
     */
    public function onLocaleChanged($event) {
        if (Config::get('log.localechanged') == true) {
            if (!is_array($event)) {
                $event = array($event);
            }
            Log::debug('Locale Changed', $event);
        }
    }
}
