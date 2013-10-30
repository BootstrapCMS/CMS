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

abstract class AppCommand extends Command {

    /**
     * Get the queue to use.
     *
     * @param  string  $type
     * @return string
     */
    protected function getQueue($type) {
        if ($this->laravel['config']['queue.default'] == 'sync') {
            return $type;
        } else {
            return $this->laravel['config']['queue.connections.'.$this->laravel['config']['queue.default'].'.'.$type];
        }
    }

    /**
     * Regenerate the app encryption key.
     *
     * @return void
     */
    protected function genAppKey() {
        $this->call('key:generate');
        $this->laravel['encrypter']->setKey($this->laravel['config']['app.key']);
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
        $this->laravel['navigation']->regen();
        $this->info('Cache regenerated!');
    }

    /**
     * Start the cron jobs.
     *
     * @return void
     */
    protected function startCron() {
        $this->line('Starting cron...');
        if ($this->laravel['config']['queue.default'] == 'sync') {
            $this->error('Cron cannot run on the sync queue.');
            $this->comment('Please change the queue in the config.');
        } else {
            $this->laravel['cron']->start(30);
            $this->info('Cron started!');
        }
    }

    /**
     * Try to start the cron jobs.
     *
     * @return void
     */
    protected function tryStartCron() {
        if ($this->laravel['config']['queue.default'] == 'sync') {
            $this->comment('Please note that cron functionality is disabled.');
        } else {
            $this->startCron();
        }
    }

    /**
     * Stop the cron jobs.
     *
     * @return void
     */
    protected function stopCron() {
        $this->line('Stopping cron...');
        $this->laravel['cron']->stop();
        $this->info('Cron stopped!');
    }

    /**
     * Clear the queue.
     *
     * @return void
     */
    protected function clearQueue() {
        $this->line('Clearing the queue...');
        $this->laravel['queuing']->clearAll();
        $this->info('Queue cleared!');
        $this->comment('Note that cron jobs were cleared too.');
    }

    /**
     * Get the queue length.
     *
     * @return void
     */
    protected function getQueueLength() {
        $this->line('Getting queue length...');
        $length = $this->laravel['queuing']->length();
        if (is_int($length)) {
            if ($length > 1) {
                $this->info('There are no jobs in the queue.');
            } elseif ($length == 1) {
                $this->info('There is 1 job in the queue.');
            } else {
                $this->info('There are '.$length.' jobs in the queue.');
            }
        } else {
            $this->error('Queue information is currently unavailable!');
        }        
    }

    /**
     * Setup IronMQ queuing.
     *
     * @param  string  $url
     * @return void
     */
    protected function ironQueue($url) {
        $this->line('Setting up iron queueing...');

        if ($this->laravel['config']['queue.default'] !== 'iron') {
            $this->error('The current config is not setup for iron queueing!');
        }

        $url = $url.'/queue/receive';

        $queue = $this->getQueue('queue');
        $this->call('queue:subscribe', array('queue' => $queue, 'url' => $url));

        $queue = $this->getQueue('mail');
        $this->call('queue:subscribe', array('queue' => $queue, 'url' => $url));

        $queue = $this->getQueue('cron');
        $this->call('queue:subscribe', array('queue' => $queue, 'url' => $url));

        $this->info('Queueing is now setup!');
    }
}
