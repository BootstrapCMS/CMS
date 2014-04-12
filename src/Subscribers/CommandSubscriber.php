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
use Illuminate\Console\Command;
use Illuminate\Events\Dispatcher;

/**
 * This is the command subscriber class.
 *
 * @package    Bootstrap-CMS
 * @author     Graham Campbell
 * @copyright  Copyright (C) 2013-2014  Graham Campbell
 * @license    https://github.com/GrahamCampbell/Bootstrap-CMS/blob/master/LICENSE.md
 * @link       https://github.com/GrahamCampbell/Bootstrap-CMS
 */
class CommandSubscriber
{
    /**
     * The page provider instance.
     *
     * @var \GrahamCampbell\BootstrapCMS\Providers\PageProvider
     */
    protected $pageprovider;

    /**
     * Create a new instance.
     *
     * @param  \GrahamCampbell\BootstrapCMS\Providers\PageProvider  $pageprovider
     * @return void
     */
    public function __construct(PageProvider $pageprovider)
    {
        $this->pageprovider = $pageprovider;
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     * @return array
     */
    public function subscribe(Dispatcher $events)
    {
        $events->listen('command.updatecache',
            'GrahamCampbell\BootstrapCMS\Subscribers\CommandSubscriber@onUpdateCache', 3);
    }

    /**
     * Handle a command.updatecache event.
     *
     * @param  \Illuminate\Console\Command  $command
     * @return void
     */
    public function onUpdateCache(Command $command)
    {
        $command->line('Regenerating page cache...');
        $this->pageprovider->refresh();
        $command->info('Page cache regenerated!');
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
