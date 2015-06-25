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

/**
 * This is the caching test class.
 *
 * @group caching
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class CachingTest extends AbstractTestCase
{
    public function testIndex()
    {
        $this->markTestSkipped('Tests requiring authentication are currently broken.');

        $this->call('GET', 'caching');

        $this->assertResponseOk();

        $this->assertSee('Caching');
        $this->assertSee('Caching controls coming soon...');
    }
}
