<?php namespace GrahamCampbell\BootstrapCMS\Commands;

class AppUpdate extends AppCommand {

    /**
     * The command name.
     *
     * @var string
     */
    protected $name = 'app:update';

    /**
     * The command description.
     *
     * @var string
     */
    protected $description = 'Updates Bootstrap CMS';

    /**
     * Run the commend.
     *
     * @return void
     */
    public function fire() {
        $this->runMigrations();
        $this->genAssets();
        $this->updateCache();
    }
}
