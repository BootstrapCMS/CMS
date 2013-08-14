<?php namespace GrahamCampbell\BootstrapCMS\Handlers;

class TestHandler extends BaseHandler {

    /**
     * Run the task.
     * Called by BaseHandler.
     */
    protected function run() {
        throw new \Exception('TestHandler Error Test!');
    }
}
