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

use GrahamCampbell\TestBench\Traits\ServiceProviderTestCaseTrait;

/**
 * This is the service provider test class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class ServiceProviderTest extends AbstractTestCase
{
    use ServiceProviderTestCaseTrait;

    public function testNavigationFactoryIsInjectable()
    {
        $this->assertIsInjectable('GrahamCampbell\BootstrapCMS\Navigation\Factory');
    }

    public function testCommentRepositoryIsInjectable()
    {
        $this->assertIsInjectable('GrahamCampbell\BootstrapCMS\Repositories\CommentRepository');
    }

    public function testEventRepositoryIsInjectable()
    {
        $this->assertIsInjectable('GrahamCampbell\BootstrapCMS\Repositories\EventRepository');
    }

    public function testPageRepositoryIsInjectable()
    {
        $this->assertIsInjectable('GrahamCampbell\BootstrapCMS\Repositories\PageRepository');
    }

    public function testPostRepositoryIsInjectable()
    {
        $this->assertIsInjectable('GrahamCampbell\BootstrapCMS\Repositories\PostRepository');
    }
}
