<?php namespace GrahamCampbell\BootstrapCMS\Commands;

class AppReset extends AppCommand {

    /**
     * The command name.
     *
     * @var string
     */
    protected $name = 'app:reset';

    /**
     * The command description.
     *
     * @var string
     */
    protected $description = 'Resets And Installs Bootstrap CMS';

    /**
     * Run the commend.
     *
     * @return void
     */
    public function fire() {
        $this->genAppKey();
        $this->resetMigrations();
        $this->runMigrations();
        $this->runSeeding();
        $this->genAssets();
        $this->updateCache();
    }
}
