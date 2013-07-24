<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class AppUpdate extends Command {

    protected $name = 'app:update';

    protected $description = 'Updates Bootstrap CMS';

    /**
     * Run the command.
     */
    public function fire() {
        $this->call('migrate');
        $this->call('migrate', array('--package' => 'cartalyst/sentry'));
    }
}
