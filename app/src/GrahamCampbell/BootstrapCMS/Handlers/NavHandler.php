<?php namespace GrahamCampbell\BootstrapCMS\Handlers;

use Navigation;

class NavHandler extends BaseHandler {

    /**
     * Run the task.
     * Called by BaseHandler.
     */
    protected function run() {
        Navigation::reset();
    }
}
