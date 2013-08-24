<?php namespace GrahamCampbell\BootstrapCMS\Handlers;

class TestHandler extends BaseHandler {

    /**
     * Run the task (called by BaseHandler).
     *
     * @return void
     */
    protected function run() {
        throw new \Exception('TestHandler Error Test!');
    }
}
