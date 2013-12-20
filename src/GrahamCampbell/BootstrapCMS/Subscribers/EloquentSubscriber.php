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
 * This is the eloquent subscriber class.
 *
 * @package    Bootstrap-CMS
 * @author     Graham Campbell
 * @copyright  Copyright (C) 2013  Graham Campbell
 * @license    https://github.com/GrahamCampbell/Bootstrap-CMS/blob/develop/LICENSE.md
 * @link       https://github.com/GrahamCampbell/Bootstrap-CMS
 */
class EloquentSubscriber
{
    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     * @return array
     */
    public function subscribe($events)
    {
        $events->listen('eloquent.creating', 'GrahamCampbell\BootstrapCMS\Subscribers\EloquentSubscriber@onEloquentCreating', 5);
        $events->listen('eloquent.created', 'GrahamCampbell\BootstrapCMS\Subscribers\EloquentSubscriber@onEloquentCreated', 5);
        $events->listen('eloquent.updating', 'GrahamCampbell\BootstrapCMS\Subscribers\EloquentSubscriber@onEloquentUpdating', 5);
        $events->listen('eloquent.updated', 'GrahamCampbell\BootstrapCMS\Subscribers\EloquentSubscriber@onEloquentUpdated', 5);
        $events->listen('eloquent.deleting', 'GrahamCampbell\BootstrapCMS\Subscribers\EloquentSubscriber@onEloquentDeleting', 5);
        $events->listen('eloquent.deleted', 'GrahamCampbell\BootstrapCMS\Subscribers\EloquentSubscriber@onEloquentDeleted', 5);
        $events->listen('eloquent.saving', 'GrahamCampbell\BootstrapCMS\Subscribers\EloquentSubscriber@onEloquentSaving', 5);
        $events->listen('eloquent.saved', 'GrahamCampbell\BootstrapCMS\Subscribers\EloquentSubscriber@onEloquentSaved', 5);
        $events->listen('eloquent.restoring', 'GrahamCampbell\BootstrapCMS\Subscribers\EloquentSubscriber@onEloquentRestoring', 5);
        $events->listen('eloquent.restored', 'GrahamCampbell\BootstrapCMS\Subscribers\EloquentSubscriber@onEloquentRestored', 5);
    }

    /**
     * Handle an eloquent.creating event.
     *
     * @param  mixed  $event
     * @return void
     */
    public function onEloquentCreating($event)
    {
        if (Config::get('log.eloquenting') == true) {
            if (!is_array($event)) {
                $event = array($event);
            }
            Log::debug('Eloquent Creating', $event);
        }
    }

    /**
     * Handle an eloquent.created event.
     *
     * @param  mixed  $event
     * @return void
     */
    public function onEloquentCreated($event)
    {
        if (Config::get('log.eloquented') == true) {
            if (!is_array($event)) {
                $event = array($event);
            }
            Log::debug('Eloquent Created', $event);
        }
    }

    /**
     * Handle an eloquent.updating event.
     *
     * @param  mixed  $event
     * @return void
     */
    public function onEloquentUpdating($event)
    {
        if (Config::get('log.eloquenting') == true) {
            if (!is_array($event)) {
                $event = array($event);
            }
            Log::debug('Eloquent Updating', $event);
        }
    }

    /**
     * Handle an eloquent.updated event.
     *
     * @param  mixed  $event
     * @return void
     */
    public function onEloquentUpdated($event)
    {
        if (Config::get('log.eloquented') == true) {
            if (!is_array($event)) {
                $event = array($event);
            }
            Log::debug('Eloquent Updated', $event);
        }
    }

    /**
     * Handle an eloquent.deleting event.
     *
     * @param  mixed  $event
     * @return void
     */
    public function onEloquentDeleting($event)
    {
        if (Config::get('log.eloquenting') == true) {
            if (!is_array($event)) {
                $event = array($event);
            }
            Log::debug('Eloquent Deleting', $event);
        }
    }

    /**
     * Handle an eloquent.deleted event.
     *
     * @param  mixed  $event
     * @return void
     */
    public function onEloquentDeleted($event)
    {
        if (Config::get('log.eloquented') == true) {
            if (!is_array($event)) {
                $event = array($event);
            }
            Log::debug('Eloquent Deleted', $event);
        }
    }

    /**
     * Handle an eloquent.saving event.
     *
     * @param  mixed  $event
     * @return void
     */
    public function onEloquentSaving($event)
    {
        if (Config::get('log.eloquenting') == true) {
            if (!is_array($event)) {
                $event = array($event);
            }
            Log::debug('Eloquent Saving', $event);
        }
    }

    /**
     * Handle an eloquent.saved event.
     *
     * @param  mixed  $event
     * @return void
     */
    public function onEloquentSaved($event)
    {
        if (Config::get('log.eloquented') == true) {
            if (!is_array($event)) {
                $event = array($event);
            }
            Log::debug('Eloquent Saved', $event);
        }
    }

    /**
     * Handle an eloquent.restoring event.
     *
     * @param  mixed  $event
     * @return void
     */
    public function onEloquentRestoring($event)
    {
        if (Config::get('log.eloquenting') == true) {
            if (!is_array($event)) {
                $event = array($event);
            }
            Log::debug('Eloquent Restoring', $event);
        }
    }

    /**
     * Handle an eloquent.restored event.
     *
     * @param  mixed  $event
     * @return void
     */
    public function onEloquentRestored($event)
    {
        if (Config::get('log.eloquented') == true) {
            if (!is_array($event)) {
                $event = array($event);
            }
            Log::debug('Eloquent Restored', $event);
        }
    }
}
