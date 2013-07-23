<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class AppInstall extends Command {

    protected $name = 'app:install';

    protected $description = 'Installs Bootstrap CMS';

    /**
     * Run the command.
     */
    public function fire() {
        $this->call('down');
        echo "Pausing for 2 seconds to ensure there is no db activity from web requests.\r\n";
        sleep(2);
        $this->call('key:generate');
        $this->call('migrate');
        $this->call('migrate', array('--package' => 'cartalyst/sentry'));
        $this->call('db:seed');
        $this->call('up');
    }
}
