<?php

/*
 * This file is part of Bootstrap CMS.
 *
 * (c) Graham Campbell <graham@alt-three.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\Tests\BootstrapCMS;

use Illuminate\Contracts\Console\Kernel;

/**
 * This is the basic test class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class BasicTest extends AbstractTestCase
{
    /**
     * @before
     */
    public function runInstallCommand()
    {
        $this->app->make(Kernel::class)->call('app:install');
    }

    public function testBase()
    {
        $this->visit('/')->seePageIs('pages/home');
    }

    public function testBlog()
    {
        $this->visit('blog')->seePageIs('blog/posts');
    }
}
