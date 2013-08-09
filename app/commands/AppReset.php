<?php

class AppReset extends AppCommand {

    protected $name        = 'app:reset';
    protected $description = 'Resets And Installs Bootstrap CMS';

    /**
     * Run the command.
     */
    public function fire() {
        $this->genAppKey();
        $this->resetMigrations();
        $this->runMigrations();
        $this->runSeeding();
        $this->genAssets();
    }
}
