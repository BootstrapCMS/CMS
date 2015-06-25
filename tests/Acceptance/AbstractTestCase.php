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

/**
 * This is the abstract test case class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
abstract class AbstractTestCase extends BaseTestCase
{
    /**
     * Run extra setup code.
     *
     * @return void
     */
    protected function start()
    {
        $this->app->make('Illuminate\Contracts\Console\Kernel')->call('app:install');
    }

    protected function callAgain()
    {
        $this->refreshApplication();

        $this->start();

        return call_user_func_array([$this, 'call'], func_get_args());
    }

    /**
     * Run extra tear down code.
     *
     * @return void
     */
    protected function finish()
    {
        $this->app = null;
    }
}
