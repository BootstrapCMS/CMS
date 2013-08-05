<?php

class AppUpdate extends AppCommand {

    protected $name = 'app:update';

    protected $description = 'Updates Bootstrap CMS';

    /**
     * Run the command.
     */
    public function fire() {
        $this->runMigrations();
        $this->genAssets();
    }
}
