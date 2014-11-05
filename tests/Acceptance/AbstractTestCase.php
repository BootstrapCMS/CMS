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

namespace GrahamCampbell\Tests\BootstrapCMS\Acceptance;

use GrahamCampbell\Tests\BootstrapCMS\AbstractTestCase as BaseTestCase;

/**
 * This is the abstract test case class.
 *
 * @author    Graham Campbell <graham@mineuk.com>
 * @copyright 2013-2014 Graham Campbell
 * @license   <https://github.com/GrahamCampbell/Bootstrap-CMS/blob/master/LICENSE.md> AGPL 3.0
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
