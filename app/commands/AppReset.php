<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class AppReset extends Command {

    protected $name = 'app:reset';

    protected $description = 'Resets And Installs Bootstrap CMS';

    /**
     * Run the command.
     */
    public function fire() {
        $this->call('key:generate');
        $this->call('migrate:refresh');
        $this->call('migrate', array('--package' => 'cartalyst/sentry'));
        $this->call('db:seed');
    }
}
