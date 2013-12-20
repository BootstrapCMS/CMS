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

namespace GrahamCampbell\BootstrapCMS\Commands;

use Illuminate\Console\Command;

/**
 * This is the abstract command class.
 *
 * @package    Bootstrap-CMS
 * @author     Graham Campbell
 * @copyright  Copyright (C) 2013  Graham Campbell
 * @license    https://github.com/GrahamCampbell/Bootstrap-CMS/blob/develop/LICENSE.md
 * @link       https://github.com/GrahamCampbell/Bootstrap-CMS
 */
abstract class AbstractCommand extends Command
{
    /**
     * Regenerate the app encryption key.
     *
     * @return void
     */
    protected function genAppKey()
    {
        $this->call('key:generate');
        $this->laravel['encrypter']->setKey($this->laravel['config']['app.key']);
    }

    /**
     * Reset all database migrations.
     *
     * @return void
     */
    protected function resetMigrations()
    {
        $this->call('migrate:reset');
    }

    /**
     * Run the database migrations.
     *
     * @return void
     */
    protected function runMigrations()
    {
        $this->call('migrate', array('--package' => 'cartalyst/sentry'));
        $this->call('migrate', array('--package' => 'graham-campbell/queuing'));
        $this->call('migrate', array('--package' => 'graham-campbell/cms-core'));
        $this->call('migrate');
    }

    /**
     * Seed the database.
     *
     * @return void
     */
    protected function runSeeding()
    {
        $this->call('db:seed', array('--class' => 'GrahamCampbell\CMSCore\Seeds\DatabaseSeeder'));
        $this->call('db:seed');
    }

    /**
     * Generated the assets.
     *
     * @return void
     */
    protected function genAssets()
    {
        $this->line('Publishing assets...');
        $this->call('debugbar:publish');
        $this->info('Assets published!');
        $this->line('Building assets...');
        $this->call('asset:generate');
        $this->info('Assets built!');
    }

    /**
     * Update the relevant cache.
     *
     * @return void
     */
    protected function updateCache()
    {
        $this->line('Regenerating cache...');
        $this->call('cache:clear');
        $this->laravel['pageprovider']->refresh();
        $this->info('Cache regenerated!');
    }

    /**
     * Try to start the cron jobs.
     *
     * @return void
     */
    protected function tryStartCron()
    {
        if ($this->laravel['config']['queue.default'] == 'sync') {
            $this->comment('Please note that cron functionality is disabled.');
        } else {
            $this->call('cron:start');
        }
    }
}
