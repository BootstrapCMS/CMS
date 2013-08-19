<?php namespace GrahamCampbell\BootstrapCMS\Commands;

use Illuminate\Console\Command;
use Navigation;

abstract class AppCommand extends Command {

    protected function genAppKey() {
        $this->call('key:generate');
    }

    protected function resetMigrations() {
        $this->call('migrate:reset');
    }

    protected function runMigrations() {
        $this->call('migrate', array('--package' => 'cartalyst/sentry'));
        $this->call('migrate');
    }

    protected function runSeeding() {
        $this->call('db:seed');
    }

    protected function genAssets() {
        $this->call('basset:build', array('--production' => true));
    }

    protected function updateCache() {
        Navigation::refresh();
    }
}