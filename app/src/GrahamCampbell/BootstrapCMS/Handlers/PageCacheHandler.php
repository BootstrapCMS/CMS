<?php namespace GrahamCampbell\BootstrapCMS\Handlers;

use GrahamCampbell\BootstrapCMS\Facades\PageProvider;

class PageCacheHandler extends BaseHandler {

    /**
     * Run the task.
     * Called by BaseHandler.
     */
    protected function run() {
        PageProvider::refresh();
    }
}
