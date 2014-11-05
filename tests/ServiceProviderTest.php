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

use GrahamCampbell\TestBench\Traits\ServiceProviderTestCaseTrait;

/**
 * This is the service provider test class.
 *
 * @author    Graham Campbell <graham@mineuk.com>
 * @copyright 2013-2014 Graham Campbell
 * @license   <https://github.com/GrahamCampbell/Bootstrap-CMS/blob/master/LICENSE.md> AGPL 3.0
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
