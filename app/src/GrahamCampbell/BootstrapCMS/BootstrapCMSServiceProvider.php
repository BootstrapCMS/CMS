<?php namespace GrahamCampbell\BootstrapCMS;

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

use Illuminate\Support\ServiceProvider;

class BootstrapCMSServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot() {
        //
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {
        // $this->app['navigation']->addItem('main', array());
        // Navigation::addItem('main', array());

        // add the blog page after the fist page if blogging is enabled
        if (Config::get('cms.blogging')) {
            Navigation::addItem('main', array('title' => 'Blog', 'slug' => 'blog/posts', 'icon' => 'icon-book'));
        }

        // add the events page after the fist page if events are enabled
        if (Config::get('cms.events')) {
            Navigation::addItem('main', array('title' => 'Events', 'slug' => 'events', 'icon' => 'icon-calendar'));
        }


        // add the profile links
        Navigation::addItem('bar', array('title' => 'View Profile', 'slug' => 'account/profile', 'icon' => 'icon-cog'));

        // add the admin links
        if (Sentry::getUser()->hasAccess('admin')) {
            Navigation::addItem('bar', array('title' => 'View Logs', 'slug' => 'logviewer', 'icon' => 'icon-wrench'));
            Navigation::addItem('bar', array('title' => 'Caching', 'slug' => 'caching', 'icon' => 'icon-dashboard'));
            Navigation::addItem('bar', array('title' => 'CloudFlare', 'slug' => 'cloudflare', 'icon' => 'icon-cloud'));
        }

        // add the view users link
        if (Sentry::getUser()->hasAccess('mod')) {
            Navigation::addItem('bar', array('title' => 'View Users', 'slug' => 'users', 'icon' => 'icon-user'));
        }

        // add the create user link
        if (Sentry::getUser()->hasAccess('admin')) {
            Navigation::addItem('bar', array('title' => 'Create User', 'slug' => 'users/create', 'icon' => 'icon-star'));
        }

        // add the create page link
        if (Sentry::getUser()->hasAccess('edit')) {
            Navigation::addItem('bar', array('title' => 'Create Page', 'slug' => 'pages/create', 'icon' => 'icon-pencil'));
        }

        // add the create post link
        if (Config::get('cms.blogging')) {
            if (Sentry::getUser()->hasAccess('blog')) {
                Navigation::addItem('bar', array('title' => 'Create Post', 'slug' => 'blog/posts/create', 'icon' => 'icon-book'));
            }
        }

        // add the create event link
        if (Config::get('cms.events')) {
            if (Sentry::getUser()->hasAccess('edit')) {
                Navigation::addItem('bar', array('title' => 'Create Event', 'slug' => 'events/create', 'icon' => 'icon-calendar'));
            }
        }


        // add the admin links
        if (Sentry::getUser()->hasAccess('admin')) {
            Navigation::addItem('admin', array('title' => 'Logs', 'slug' => 'logviewer', 'icon' => 'icon-wrench'));
            Navigation::addItem('admin', array('title' => 'Caching', 'slug' => 'caching', 'icon' => 'icon-dashboard'));
            Navigation::addItem('admin', array('title' => 'CloudFlare', 'slug' => 'cloudflare', 'icon' => 'icon-cloud'));
        }

        // add the view users link
        if (Sentry::getUser()->hasAccess('mod')) {
            Navigation::addItem('admin', array('title' => 'Users', 'slug' => 'users', 'icon' => 'icon-user'));
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides() {
        return array();
    }
}
