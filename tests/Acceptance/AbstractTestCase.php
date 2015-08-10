<?php

/*
 * This file is part of Bootstrap CMS.
 *
 * (c) Graham Campbell <graham@alt-three.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\Tests\BootstrapCMS\Acceptance;

use GrahamCampbell\Tests\BootstrapCMS\AbstractTestCase as BaseTestCase;
use Illuminate\Contracts\Console\Kernel;

/**
 * This is the abstract test case class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
abstract class AbstractTestCase extends BaseTestCase
{
    /**
     * @before
     */
    public function runInstallCommand()
    {
        $this->app->make(Kernel::class)->call('app:install');
    }
}
