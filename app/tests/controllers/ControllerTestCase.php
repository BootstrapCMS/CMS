<?php

class ControllerTestCase extends TestCase {

    /**
     * Finish up with mockery.
     * This will be called by PHPUnit.
     *
     */
    public function tearDown() {
        Mockery::close();
    }
}
