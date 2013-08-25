<?php namespace GrahamCampbell\BootstrapCMS\Commands;

use Illuminate\Console\Command;
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
        $this->call('migrate');
    }

    /**
     * Seed the database.
     *
     * @return void
     */
    protected function runSeeding() {
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
        Navigation::refresh();
    }
}
