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

use Illuminate\Config\Repository;
use Illuminate\Events\Dispatcher;
use Illuminate\Log\Writer;

/**
 * This is the core subscriber class.
 *
 * @author    Graham Campbell <graham@mineuk.com>
 * @copyright 2013-2014 Graham Campbell
 * @license   <https://github.com/GrahamCampbell/Bootstrap-CMS/blob/master/LICENSE.md> AGPL 3.0
 */
class CoreSubscriber
{
    /**
     * The config instance.
     *
     * @type \Illuminate\Config\Repository
     */
    protected $config;

    /**
     * The log instance.
     *
     * @type \Illuminate\Log\Writer
     */
    protected $log;

    /**
     * Create a new instance.
     *
     * @param \Illuminate\Config\Repository $config
     * @param \Illuminate\Log\Writer        $log
     *
     * @return void
     */
    public function __construct(Repository $config, Writer $log)
    {
        $this->config = $config;
        $this->log = $log;
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
            'page.load',
            'GrahamCampbell\BootstrapCMS\Subscribers\CoreSubscriber@onPageLoad',
            5
        );
        $events->listen(
            'artisan.start',
            'GrahamCampbell\BootstrapCMS\Subscribers\CoreSubscriber@onArtisanStart',
            5
        );
        $events->listen(
            'illuminate.query',
            'GrahamCampbell\BootstrapCMS\Subscribers\CoreSubscriber@onIlluminateQuery',
            5
        );
        $events->listen(
            'locale.changed',
            'GrahamCampbell\BootstrapCMS\Subscribers\CoreSubscriber@onLocaleChanged',
            5
        );
    }

    /**
     * Handle a page.load event.
     *
     * @param mixed $event
     *
     * @return void
     */
    public function onPageLoad($event = array())
    {
        if ($this->config->get('log.pageload') == true) {
            if (!is_array($event)) {
                $event = array($event);
            }
            $this->log->debug('Page Loading', $event);
        }
    }

    /**
     * Handle an artisan.start event.
     *
     * @param mixed $event
     *
     * @return void
     */
    public function onArtisanStart($event = array())
    {
        if ($this->config->get('log.artisanstart') == true) {
            if (!is_array($event)) {
                $event = array($event);
            }
            $this->log->debug('Artisan Starting', $event);
        }
    }

    /**
     * Handle a illuminate.query event.
     *
     * @param mixed $event
     *
     * @return void
     */
    public function onIlluminateQuery($event = array())
    {
        if ($this->config->get('log.illuminatequery') == true) {
            if (!is_array($event)) {
                $event = array($event);
            }
            $this->log->debug('Query Executed', $event);
        }
    }

    /**
     * Handle a locale.changed event.
     *
     * @param mixed $event
     *
     * @return void
     */
    public function onLocaleChanged($event = array())
    {
        if ($this->config->get('log.localechanged') == true) {
            if (!is_array($event)) {
                $event = array($event);
            }
            $this->log->debug('Locale Changed', $event);
        }
    }

    /**
     * Get the config instance.
     *
     * @return \Illuminate\Config\Repository
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Get the log instance.
     *
     * @return \Illuminate\Log\Writer
     */
    public function getLog()
    {
        return $this->log;
    }
}
