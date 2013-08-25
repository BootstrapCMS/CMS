<?php namespace GrahamCampbell\BootstrapCMS\Handlers;

use PageProvider;

class PageCacheHandler extends BaseHandler {

    /**
     * Run the task (called by BaseHandler).
     *
     * @return void
     */
    protected function run() {
        PageProvider::refresh();
    }
}
