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

use GrahamCampbell\BootstrapCMS\Repositories\PageRepository;
use Illuminate\Console\Command;
use Illuminate\Events\Dispatcher;

/**
 * This is the command subscriber class.
 *
 * @author    Graham Campbell <graham@mineuk.com>
 * @copyright 2013-2014 Graham Campbell
 * @license   <https://github.com/GrahamCampbell/Bootstrap-CMS/blob/master/LICENSE.md> AGPL 3.0
 */
class CommandSubscriber
{
    /**
     * The page repository instance.
     *
     * @var \GrahamCampbell\BootstrapCMS\Repositories\PageRepository
     */
    protected $pagerepository;

    /**
     * Create a new instance.
     *
     * @param \GrahamCampbell\BootstrapCMS\Repositories\PageRepository $pagerepository
     *
     * @return void
     */
    public function __construct(PageRepository $pagerepository)
    {
        $this->pagerepository = $pagerepository;
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
            'command.runmigrations',
            'GrahamCampbell\BootstrapCMS\Subscribers\CommandSubscriber@onRunMigrations',
            6
        );

        $events->listen(
            'command.updatecache',
            'GrahamCampbell\BootstrapCMS\Subscribers\CommandSubscriber@onUpdateCache',
            3
        );
    }

    /**
     * Handle a command.runmigrations event.
     *
     * @param \Illuminate\Console\Command $command
     *
     * @return void
     */
    public function onRunMigrations(Command $command)
    {
        $command->call('migrate', ['--package' => 'barryvdh/laravel-async-queue', '--force' => true]);
    }

    /**
     * Handle a command.updatecache event.
     *
     * @param \Illuminate\Console\Command $command
     *
     * @return void
     */
    public function onUpdateCache(Command $command)
    {
        $command->line('Regenerating page cache...');
        $this->pagerepository->refresh();
        $command->info('Page cache regenerated!');
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
