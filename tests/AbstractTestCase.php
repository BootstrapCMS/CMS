<?php

/**
 * This file is part of Bootstrap CMS by Graham Campbell.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 */

namespace GrahamCampbell\Tests\BootstrapCMS;

use GrahamCampbell\TestBench\Traits\HelperTestCaseTrait;
use GrahamCampbell\TestBench\Traits\LaravelTestCaseTrait;
use Illuminate\Foundation\Testing\TestCase;
use Orchestra\Testbench\Traits\ClientTrait as OrchestralClientTrait;
use Orchestra\Testbench\Traits\PHPUnitAssertionsTrait as OrchestralAssertionsTrait;

/**
 * This is the abstract test case class.
 *
 * @author    Graham Campbell <graham@mineuk.com>
 * @copyright 2013-2014 Graham Campbell
 * @license   <https://github.com/GrahamCampbell/Bootstrap-CMS/blob/master/LICENSE.md> AGPL 3.0
 */
abstract class AbstractTestCase extends TestCase
{
    use HelperTestCaseTrait, LaravelTestCaseTrait, OrchestralClientTrait, OrchestralAssertionsTrait;

    /**
     * Creates the application.
     *
     * @return \Symfony\Component\HttpKernel\HttpKernelInterface
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        if (!$app->hasBeenBootstrapped()) {
            $app->bootstrapWith([
                'Illuminate\Foundation\Bootstrap\DetectEnvironment',
                'Illuminate\Foundation\Bootstrap\LoadConfiguration',
                'Illuminate\Foundation\Bootstrap\ConfigureLogging',
                'Illuminate\Foundation\Bootstrap\HandleExceptions',
                'Illuminate\Foundation\Bootstrap\RegisterFacades',
                'Illuminate\Foundation\Bootstrap\SetRequestForConsole',
                'Illuminate\Foundation\Bootstrap\RegisterProviders',
                'Illuminate\Foundation\Bootstrap\BootProviders',
            ]);
        }

        return $app;
    }

    /**
     * Get the service provider class.
     *
     * @return string
     */
    protected function getServiceProviderClass()
    {
        return 'GrahamCampbell\BootstrapCMS\BootstrapCMSServiceProvider';
    }

    /**
     * Clean up the testing environment before the next test.
     *
     * @return void
     */
    public function tearDown()
    {
        if ($this->app) {
            $this->app->flush();
        }
    }
}
