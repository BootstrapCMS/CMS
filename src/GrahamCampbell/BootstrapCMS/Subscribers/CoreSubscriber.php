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
use Illuminate\Support\Facades\Log;

/**
 * This is the core subscriber class.
 *
 * @package    Bootstrap-CMS
 * @author     Graham Campbell
 * @copyright  Copyright (C) 2013  Graham Campbell
 * @license    https://github.com/GrahamCampbell/Bootstrap-CMS/blob/develop/LICENSE.md
 * @link       https://github.com/GrahamCampbell/Bootstrap-CMS
 */
class CoreSubscriber
{
    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     * @return array
     */
    public function subscribe($events)
    {
        $events->listen('page.load', 'GrahamCampbell\BootstrapCMS\Subscribers\CoreSubscriber@onPageLoad', 5);
        $events->listen('artisan.start', 'GrahamCampbell\BootstrapCMS\Subscribers\CoreSubscriber@onArtisanStart', 5);
        $events->listen('illuminate.query', 'GrahamCampbell\BootstrapCMS\Subscribers\CoreSubscriber@onIlluminateQuery', 5);
        $events->listen('locale.changed', 'GrahamCampbell\BootstrapCMS\Subscribers\CoreSubscriber@onLocaleChanged', 5);
    }

    /**
     * Handle a page.load event.
     *
     * @param  mixed  $event
     * @return void
     */
    public function onPageLoad($event)
    {
        if (Config::get('log.pageload') == true) {
            if (!is_array($event)) {
                $event = array($event);
            }
            Log::debug('Page Loading', $event);
        }
    }

    /**
     * Handle an artisan.start event.
     *
     * @param  mixed  $event
     * @return void
     */
    public function onArtisanStart($event)
    {
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
    public function onIlluminateQuery($event)
    {
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
    public function onLocaleChanged($event)
    {
        if (Config::get('log.localechanged') == true) {
            if (!is_array($event)) {
                $event = array($event);
            }
            Log::debug('Locale Changed', $event);
        }
    }
}
