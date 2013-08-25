<?php namespace GrahamCampbell\BootstrapCMS\Tests;

use Illuminate\Foundation\Testing\TestCase as LaravelTestCase;

abstract class TestCase extends LaravelTestCase {

    /**
     * Creates the application.
     *
     * @return \Symfony\Component\HttpKernel\HttpKernelInterface
     */
    public function createApplication() {
        $unitTesting = true;
        $testEnvironment = 'testing';
        return require __DIR__.'/../../../../../bootstrap/start.php';
    }
}
