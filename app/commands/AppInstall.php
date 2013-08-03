<?php

class AppInstall extends AppCommand {

    protected $name = 'app:install';

    protected $description = 'Installs Bootstrap CMS';

    /**
     * Run the command.
     */
    public function fire() {
        $this->genAppKey();
        $this->runMigrations();
        $this->runSeeding();
        $this->genAssets();
    }
}
