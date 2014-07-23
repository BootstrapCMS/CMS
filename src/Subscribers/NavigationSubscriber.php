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

use GrahamCampbell\BootstrapCMS\Providers\PageProvider;
use GrahamCampbell\Credentials\Credentials;
use GrahamCampbell\Navigation\Navigation;
use Illuminate\Config\Repository;
use Illuminate\Events\Dispatcher;

/**
 * This is the navigation subscriber class.
 *
 * @package    Bootstrap-CMS
 * @author     Graham Campbell
 * @copyright  Copyright (C) 2013-2014  Graham Campbell
 * @license    https://github.com/GrahamCampbell/Bootstrap-CMS/blob/master/LICENSE.md
 * @link       https://github.com/GrahamCampbell/Bootstrap-CMS
 */
class NavigationSubscriber
{
    /**
     * The navigation instance.
     *
     * @var \GrahamCampbell\Navigation\Navigation
     */
    protected $navigation;

    /**
     * The credentials instance.
     *
     * @var \GrahamCampbell\Credentials\Credentials
     */
    protected $credentials;

    /**
     * The page provider instance.
     *
     * @var \GrahamCampbell\BootstrapCMS\Providers\PageProvider
     */
    protected $pageprovider;

    /**
     * The blogging flag.
     *
     * @var bool
     */
    protected $blogging;

    /**
     * The events flag.
     *
     * @var bool
     */
    protected $events;

    /**
     * The cloudflare flag.
     *
     * @var bool
     */
    protected $cloudflare;

    /**
     * Create a new instance.
     *
     * @param  \GrahamCampbell\Navigation\Navigation  $navigation
     * @param  \GrahamCampbell\Credentials\Credentials  $credentials
     * @param  \GrahamCampbell\BootstrapCMS\Providers\PageProvider  $pageprovider
     * @param  bool  $blogging
     * @param  bool  $events
     * @param  bool  $cloudflare
     * @return void
     */
    public function __construct(
        Navigation $navigation,
        Credentials $credentials,
        PageProvider $pageprovider
        $blogging = false,
        $events = false,
        $cloudflare = false
    ) {
        $this->navigation = $navigation;
        $this->credentials = $credentials;
        $this->pageprovider = $pageprovider;
        $this->blogging = $blogging;
        $this->events = $events;
        $this->cloudflare = $cloudflare;
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     * @return array
     */
    public function subscribe(Dispatcher $events)
    {
        $events->listen(
            'navigation.main',
            'GrahamCampbell\BootstrapCMS\Subscribers\NavigationSubscriber@onNavigationMainFirst',
            8
        );
        $events->listen(
            'navigation.main',
            'GrahamCampbell\BootstrapCMS\Subscribers\NavigationSubscriber@onNavigationMainSecond',
            5
        );
        $events->listen(
            'navigation.main',
            'GrahamCampbell\BootstrapCMS\Subscribers\NavigationSubscriber@onNavigationMainThird',
            2
        );
        $events->listen(
            'navigation.bar',
            'GrahamCampbell\BootstrapCMS\Subscribers\NavigationSubscriber@onNavigationBarFirst',
            8
        );
        $events->listen(
            'navigation.bar',
            'GrahamCampbell\BootstrapCMS\Subscribers\NavigationSubscriber@onNavigationBarSecond',
            5
        );
        $events->listen(
            'navigation.bar',
            'GrahamCampbell\BootstrapCMS\Subscribers\NavigationSubscriber@onNavigationBarThird',
            2
        );
    }

    /**
     * Handle a navigation.main event first.
     *
     * @param  array  $event
     * @return void
     */
    public function onNavigationMainFirst(array $event = array())
    {
        // add the blog
        if ($this->blogging) {
            $this->navigation->addToMain(
                array('title' => 'Blog', 'slug' => 'blog/posts', 'icon' => 'book')
            );
        }

        // add the events
        if ($this->events) {
            $this->navigation->addToMain(
                array('title' => 'Events', 'slug' => 'events', 'icon' => 'calendar')
            );
        }
    }

    /**
     * Handle a navigation.main event second.
     *
     * @param  array  $event
     * @return void
     */
    public function onNavigationMainSecond(array $event = array())
    {
        // get the pages
        $pages = $this->pageprovider->navigation();

        // delete the home page
        unset($pages[0]);

        // add the pages to the nav bar
        foreach ($pages as $page) {
            $this->navigation->addToMain($page);
        }

        if ($this->credentials->check()) {
            // add the admin links
            if ($this->credentials->hasAccess('admin')) {
                $this->navigation->addToMain(
                    array('title' => 'Caching', 'slug' => 'caching', 'icon' => 'tachometer'),
                    'admin'
                );
                $this->navigation->addToMain(
                    array('title' => 'Logs', 'slug' => 'logviewer', 'icon' => 'wrench'),
                    'admin'
                );
                if ($this->cloudflare) {
                    $this->navigation->addToMain(
                        array('title' => 'CloudFlare', 'slug' => 'cloudflare', 'icon' => 'cloud'),
                        'admin'
                    );
                }
            }
        }
    }

    /**
     * Handle a navigation.main event second.
     *
     * @param  array  $event
     * @return void
     */
    public function onNavigationMainThird(array $event = array())
    {
        // get the pages
        $pages = $this->pageprovider->navigation();

        // select the home page
        $page = $pages[0];

        // add the page to the start of the main nav bars
        $this->navigation->addToMain($page, 'default', true);
        $this->navigation->addToMain($page, 'admin', true);

        // add the view users link
        if ($this->credentials->check() && $this->credentials->hasAccess('mod')) {
            $this->navigation->addToMain(
                array('title' => 'Users', 'slug' => 'users', 'icon' => 'user'),
                'admin'
            );
        }
    }

    /**
     * Handle a navigation.bar event first.
     *
     * @param  array  $event
     * @return void
     */
    public function onNavigationBarFirst(array $event = array())
    {
        if ($this->credentials->check()) {
            // add the profile/history links
            $this->navigation->addToBar(
                array('title' => 'View Profile', 'slug' => 'account/profile', 'icon' => 'cog')
            );
            $this->navigation->addToBar(
                array('title' => 'View History', 'slug' => 'account/history', 'icon' => 'history')
            );
        }
    }

    /**
     * Handle a navigation.bar event second.
     *
     * @param  array  $event
     * @return void
     */
    public function onNavigationBarSecond(array $event = array())
    {
        // add the admin links
        if ($this->credentials->check() && $this->credentials->hasAccess('admin')) {
            $this->navigation->addToBar(
                array('title' => 'Caching', 'slug' => 'caching', 'icon' => 'tachometer')
            );
            $this->navigation->addToBar(
                array('title' => 'View Logs', 'slug' => 'logviewer', 'icon' => 'wrench')
            );
            if ($this->cloudflare) {
                $this->navigation->addToBar(
                    array('title' => 'CloudFlare', 'slug' => 'cloudflare', 'icon' => 'cloud')
                );
            }
        }
    }

    /**
     * Handle a navigation.bar event third.
     *
     * @param  array  $event
     * @return void
     */
    public function onNavigationBarThird(array $event = array())
    {
        if ($this->credentials->check()) {
            // add the view users link
            if ($this->credentials->hasAccess('mod')) {
                $this->navigation->addToBar(
                    array('title' => 'View Users', 'slug' => 'users', 'icon' => 'user')
                );
            }

            // add the create user link
            if ($this->credentials->hasAccess('admin')) {
                $this->navigation->addToBar(
                    array('title' => 'Create User', 'slug' => 'users/create', 'icon' => 'star')
                );
            }

            // add the create page link
            if ($this->credentials->hasAccess('edit')) {
                $this->navigation->addToBar(
                    array('title' => 'Create Page', 'slug' => 'pages/create', 'icon' => 'pencil')
                );
            }

            // add the create post link
            if ($this->blogging) {
                if ($this->credentials->hasAccess('blog')) {
                    $this->navigation->addToBar(
                        array('title' => 'Create Post', 'slug' => 'blog/posts/create', 'icon' => 'book')
                    );
                }
            }

            // add the create event link
            if ($this->events) {
                if ($this->credentials->hasAccess('edit')) {
                    $this->navigation->addToBar(
                        array('title' => 'Create Event', 'slug' => 'events/create', 'icon' => 'calendar')
                    );
                }
            }
        }
    }

    /**
     * Get the navigation instance.
     *
     * @return \GrahamCampbell\Navigation\Navigation
     */
    public function getNavigation()
    {
        return $this->navigation;
    }

    /**
     * Get the credentials instance.
     *
     * @return \GrahamCampbell\Credentials\Credentials
     */
    public function getCredentials()
    {
        return $this->credentials;
    }

    /**
     * Get the page provider instance.
     *
     * @return \GrahamCampbell\BootstrapCMS\Providers\PageProvider
     */
    public function getPageProvider()
    {
        return $this->pageprovider;
    }
}
