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
        $this->call('down');
        echo "Pausing for 2 seconds to ensure there is no db activity from web requests.\r\n";
        sleep(2);
        $this->call('migrate');
        $this->call('migrate', array('--package' => 'cartalyst/sentry'));
        $this->call('up');
    }
}
