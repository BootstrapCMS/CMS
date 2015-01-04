<?php

/*
 * This file is part of Bootstrap CMS.
 *
 * (c) Graham Campbell <graham@mineuk.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\Tests\BootstrapCMS\Functional;

use GrahamCampbell\Tests\BootstrapCMS\AbstractTestCase;

/**
 * This is the command test class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
class CommandTest extends AbstractTestCase
{
    public function testInstall()
    {
        $this->assertEquals(0, $this->app['artisan']->call('app:install'));
    }

    public function testReset()
    {
        $this->assertEquals(0, $this->app['artisan']->call('migrate', ['--force' => true]));
        $this->assertEquals(0, $this->app['artisan']->call('app:reset'));
    }

    public function testUpdate()
    {
        $this->assertEquals(0, $this->app['artisan']->call('app:update'));
    }

    public function testResetAfterInstall()
    {
        $this->assertEquals(0, $this->app['artisan']->call('app:install'));
        $this->assertEquals(0, $this->app['artisan']->call('app:reset'));
    }
}
