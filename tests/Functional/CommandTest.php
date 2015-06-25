<?php

/*
 * This file is part of Bootstrap CMS.
 *
 * (c) Graham Campbell <graham@alt-three.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\Tests\BootstrapCMS\Functional;

use GrahamCampbell\Tests\BootstrapCMS\AbstractTestCase;

/**
 * This is the command test class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class CommandTest extends AbstractTestCase
{
    public function testInstall()
    {
        $this->assertSame(0, $this->getKernel()->call('app:install'));
    }

    public function testReset()
    {
        $this->assertSame(0, $this->getKernel()->call('migrate', ['--force' => true]));
        $this->assertSame(0, $this->getKernel()->call('app:reset'));
    }

    public function testUpdate()
    {
        $this->assertSame(0, $this->getKernel()->call('app:update'));
    }

    public function testResetAfterInstall()
    {
        $this->assertSame(0, $this->getKernel()->call('app:install'));
        $this->assertSame(0, $this->getKernel()->call('app:reset'));
    }

    protected function getKernel()
    {
        return $this->app->make('Illuminate\Contracts\Console\Kernel');
    }
}
