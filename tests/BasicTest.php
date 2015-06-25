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

/**
 * This is the basic test class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class BasicTest extends AbstractTestCase
{
    public function testBase()
    {
        $this->call('GET', '/');

        $this->assertRedirectedTo('pages/home');
    }

    public function testBlog()
    {
        $this->call('GET', 'blog');

        $this->assertRedirectedTo('blog/posts');
    }
}
