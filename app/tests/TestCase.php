<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase {

    /**
     * Default preparation for each test.
     * This will be called by PHPUnit.
     *
     */
    public function setUp() {
        parent::setUp();
        $this->prepareForTests();
    }

    /**
     * Setup the db in memory.
     * This will allow the tests to run quickly.
     *
     */
    private function prepareForTests() {
        Artisan::call('app:install');
    }

    /**
     * Creates the application.
     *
     * @return Symfony\Component\HttpKernel\HttpKernelInterface
     */
    public function createApplication() {
        $unitTesting = true;
        $testEnvironment = 'testing';
        return require __DIR__.'/../../bootstrap/start.php';
    }
}
