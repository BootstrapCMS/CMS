<?php namespace GrahamCampbell\BootstrapCMS\Handlers;

use PageProvider;

class PageCacheHandler extends BaseHandler {

    /**
     * Run the task.
     * Called by BaseHandler.
     */
    protected function run() {
        PageProvider::refresh();
    }
}
