<?php namespace GrahamCampbell\BootstrapCMS\Commands;

class AppInstall extends AppCommand {

    /**
     * The command name.
     *
     * @var string
     */
    protected $name = 'app:install';

    /**
     * The command description.
     *
     * @var string
     */
    protected $description = 'Installs Bootstrap CMS';

    /**
     * Run the commend.
     *
     * @return void
     */
    public function fire() {
        $this->genAppKey();
        $this->runMigrations();
        $this->runSeeding();
        $this->genAssets();
        $this->updateCache();
    }
}
