<?php namespace GrahamCampbell\BootstrapCMS\Commands;

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

use Illuminate\Console\Command;
use Cron;
use GrahamCampbell\CMSCore\Providers\JobProvider;
use Navigation;

abstract class AppCommand extends Command {

    /**
     * Regenerate the app encryption key.
     *
     * @return void
     */
    protected function genAppKey() {
        $this->call('key:generate');
    }

    /**
     * Reset all database migrations.
     *
     * @return void
     */
    protected function resetMigrations() {
        $this->call('migrate:reset');
    }

    /**
     * Run the database migrations.
     *
     * @return void
     */
    protected function runMigrations() {
        $this->call('migrate', array('--package' => 'cartalyst/sentry'));
        $this->call('migrate', array('--package' => 'graham-campbell/cms-core'));
        $this->call('migrate');
    }

    /**
     * Seed the database.
     *
     * @return void
     */
    protected function runSeeding() {
        $this->call('db:seed',  array('--class' => 'GrahamCampbell\CMSCore\Seeds\DatabaseSeeder'));
        $this->call('db:seed');
    }

    /**
     * Generated the assets.
     *
     * @return void
     */
    protected function genAssets() {
        $this->call('basset:build', array('--production' => true));
    }

    /**
     * Update the relevant cache.
     *
     * @return void
     */
    protected function updateCache() {
        $this->line('Regenerating cache...');
        Navigation::regen();
        $this->info('Cache regenerated!');
    }

    /**
     * Start the cron jobs.
     *
     * @return void
     */
    protected function startCrons() {
        $this->line('Starting crons...');
        Cron::start(30);
        $this->info('Crons started!');
    }

    /**
     * Stop the cron jobs.
     *
     * @return void
     */
    protected function stopCrons() {
        $this->line('Stopping crons...');
        Cron::stop();
        $this->info('Crons stopped!');
    }

    /**
     * Clear the queue.
     *
     * @return void
     */
    protected function clearQueue() {
        $this->line('Clearing the queue...');
        JobProvider::clearAll();
        $this->info('Queue cleared!');
        $this->comment('Note that the crons where cleared too');
    }

    /**
     * List the queue contents.
     *
     * @return void
     */
    protected function listQueue() {
        $this->info('Queue listing coming soon...');
    }

    /**
     * Get the queue length.
     *
     * @return void
     */
    protected function listQueue() {
        $this->info('Queue length information soon...');
    }
}
