<?php

class ModelTestCase extends TestCase {

    /**
     * Default preparation for each test.
     * This will be called by PHPUnit.
     *
     */
    public function setUp() {
        parent::setUp();

        Artisan::call('app:install');
    }
}
