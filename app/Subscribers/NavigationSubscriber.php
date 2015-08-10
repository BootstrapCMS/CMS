<?php

/*
 * This file is part of Bootstrap CMS.
 *
 * (c) Graham Campbell <graham@alt-three.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\BootstrapCMS\Subscribers;

use GrahamCampbell\BootstrapCMS\Repositories\PageRepository;
use GrahamCampbell\Credentials\Credentials;
use GrahamCampbell\Navigation\Navigation;
use Illuminate\Events\Dispatcher;

/**
 * This is the navigation subscriber class.
 *
 * @author Graham Campbell <graham@alt-three.com>
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
     * The page repository instance.
     *
     * @var \GrahamCampbell\BootstrapCMS\Repositories\PageRepository
     */
    protected $pagerepository;

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
     * @param \GrahamCampbell\Navigation\Navigation                    $navigation
     * @param \GrahamCampbell\Credentials\Credentials                  $credentials
     * @param \GrahamCampbell\BootstrapCMS\Repositories\PageRepository $pagerepository
     * @param bool                                                     $blogging
     * @param bool                                                     $events
     * @param bool                                                     $cloudflare
     *
     * @return void
     */
    public function __construct(
        Navigation $navigation,
        Credentials $credentials,
        PageRepository $pagerepository,
        $blogging = false,
        $events = false,
        $cloudflare = false
    ) {
        $this->navigation = $navigation;
        $this->credentials = $credentials;
        $this->pagerepository = $pagerepository;
        $this->blogging = $blogging;
        $this->events = $events;
        $this->cloudflare = $cloudflare;
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     *
     * @return void
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
     * @return void
     */
    public function onNavigationMainFirst()
    {
        // add the blog
        if ($this->blogging) {
            $this->navigation->addToMain(
                ['title' => 'Blog', 'slug' => 'blog/posts', 'icon' => 'book']
            );
        }

        // add the events
        if ($this->events) {
            $this->navigation->addToMain(
                ['title' => 'Events', 'slug' => 'events', 'icon' => 'calendar']
            );
        }
    }

    /**
     * Handle a navigation.main event second.
     *
     * @return void
     */
    public function onNavigationMainSecond()
    {
        // get the pages
        $pages = $this->pagerepository->navigation();

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
                    ['title' => 'Logs', 'slug' => 'logviewer', 'icon' => 'wrench'],
                    'admin'
                );
                if ($this->cloudflare) {
                    $this->navigation->addToMain(
                        ['title' => 'CloudFlare', 'slug' => 'cloudflare', 'icon' => 'cloud'],
                        'admin'
                    );
                }
            }
        }
    }

    /**
     * Handle a navigation.main event second.
     *
     * @return void
     */
    public function onNavigationMainThird()
    {
        // get the pages
        $pages = $this->pagerepository->navigation();

        // select the home page
        $page = $pages[0];

        // add the page to the start of the main nav bars
        $this->navigation->addToMain($page, 'default', true);
        $this->navigation->addToMain($page, 'admin', true);

        // add the view users link
        if ($this->credentials->check() && $this->credentials->hasAccess('mod')) {
            $this->navigation->addToMain(
                ['title' => 'Users', 'slug' => 'users', 'icon' => 'user'],
                'admin'
            );
        }
    }

    /**
     * Handle a navigation.bar event first.
     *
     * @return void
     */
    public function onNavigationBarFirst()
    {
        if ($this->credentials->check()) {
            // add the profile/history links
            $this->navigation->addToBar(
                ['title' => 'View Profile', 'slug' => 'account/profile', 'icon' => 'cog']
            );
            $this->navigation->addToBar(
                ['title' => 'View History', 'slug' => 'account/history', 'icon' => 'history']
            );
        }
    }

    /**
     * Handle a navigation.bar event second.
     *
     * @return void
     */
    public function onNavigationBarSecond()
    {
        // add the admin links
        if ($this->credentials->check() && $this->credentials->hasAccess('admin')) {
            $this->navigation->addToBar(
                ['title' => 'View Logs', 'slug' => 'logviewer', 'icon' => 'wrench']
            );
            if ($this->cloudflare) {
                $this->navigation->addToBar(
                    ['title' => 'CloudFlare', 'slug' => 'cloudflare', 'icon' => 'cloud']
                );
            }
        }
    }

    /**
     * Handle a navigation.bar event third.
     *
     * @return void
     */
    public function onNavigationBarThird()
    {
        if ($this->credentials->check()) {
            // add the view users link
            if ($this->credentials->hasAccess('mod')) {
                $this->navigation->addToBar(
                    ['title' => 'View Users', 'slug' => 'users', 'icon' => 'user']
                );
            }

            // add the create user link
            if ($this->credentials->hasAccess('admin')) {
                $this->navigation->addToBar(
                    ['title' => 'Create User', 'slug' => 'users/create', 'icon' => 'star']
                );
            }

            // add the create page link
            if ($this->credentials->hasAccess('edit')) {
                $this->navigation->addToBar(
                    ['title' => 'Create Page', 'slug' => 'pages/create', 'icon' => 'pencil']
                );
            }

            // add the create post link
            if ($this->blogging) {
                if ($this->credentials->hasAccess('blog')) {
                    $this->navigation->addToBar(
                        ['title' => 'Create Post', 'slug' => 'blog/posts/create', 'icon' => 'book']
                    );
                }
            }

            // add the create event link
            if ($this->events) {
                if ($this->credentials->hasAccess('edit')) {
                    $this->navigation->addToBar(
                        ['title' => 'Create Event', 'slug' => 'events/create', 'icon' => 'calendar']
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
     * Get the page repository instance.
     *
     * @return \GrahamCampbell\BootstrapCMS\Repositories\PageRepository
     */
    public function getPageRepository()
    {
        return $this->pagerepository;
    }
}
