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

use GrahamCampbell\Credentials\Facades\Credentials;

/**
 * This is the page test class.
 *
 * @group page
 *
 * @author    Graham Campbell <graham@mineuk.com>
 * @copyright 2013-2014 Graham Campbell
 * @license   <https://github.com/GrahamCampbell/Bootstrap-CMS/blob/master/LICENSE.md> AGPL 3.0
 */
class PageTest extends AbstractTestCase
{
    public function testIndex()
    {
        $this->call('GET', '/');

        $this->assertRedirectedTo('pages/home');

        $this->callAgain('GET', 'pages');

        $this->assertRedirectedTo('pages/home');
    }

    public function testCreate()
    {
        $this->markTestSkipped('Tests requiring authentication are currently broken.');

        $this->call('GET', 'pages/create');

        $this->assertResponseOk();

        $this->assertSee('Create Page');
    }

    public function testStoreFail()
    {
        $this->markTestSkipped('Tests requiring authentication are currently broken.');

        Credentials::shouldReceive('getuser')->once()->andReturn((object) ['id' => 1]);

        $this->call('POST', 'pages');

        $this->assertRedirectedTo('pages/create');
        $this->assertSessionHasErrors();
        $this->assertHasOldInput();
    }

    public function testStoreSuccess()
    {
        $this->markTestSkipped('Tests requiring authentication are currently broken.');

        Credentials::shouldReceive('getuser')->once()->andReturn((object) ['id' => 1]);

        $this->call('POST', 'pages', [
            'title'      => 'New Page',
            'nav_title'  => 'Herro',
            'slug'       => 'foobar',
            'icon'       => '',
            'body'       => 'Why herro there!',
            'css'        => '',
            'js'         => '',
            'show_title' => 'on',
            'show_nav'   => 'on',

        ]);

        $this->assertRedirectedTo('pages/foobar');
        $this->assertSessionHas('success');
    }

    /**
     * @expectedException \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     * @expectedExceptionMessage Page Not Found
     */
    public function testShowFail()
    {
        $this->call('GET', 'pages/error');
    }

    public function testShowSuccess()
    {
        $this->call('GET', 'pages/home');

        $this->assertResponseOk();

        $this->markTestSkipped('assertSee is currently unimplemented.');

        $this->assertSee('Bootstrap CMS');

        $this->callAgain('GET', 'pages/about');

        $this->assertResponseOk();
        $this->assertSee('This is the about page!');
    }

    public function testEditHome()
    {
        $this->markTestSkipped('Tests requiring authentication are currently broken.');

        $this->call('GET', 'pages/home/edit');

        $this->assertResponseOk();

        $this->assertSee('Edit Welcome');
    }

    public function testUpdateFail()
    {
        $this->markTestSkipped('Tests requiring authentication are currently broken.');

        $this->call('PATCH', 'pages/home');

        $this->assertRedirectedTo('pages/home/edit');
        $this->assertSessionHasErrors();
        $this->assertHasOldInput();
    }

    public function testUpdateHomeUrl()
    {
        $this->markTestSkipped('Tests requiring authentication are currently broken.');

        $this->call('PATCH', 'pages/home', [
            'title'      => 'New Page',
            'nav_title'  => 'Herro',
            'slug'       => 'foobar',
            'icon'       => '',
            'body'       => 'Why herro there!',
            'css'        => '',
            'js'         => '',
            'show_title' => 'on',
            'show_nav'   => 'on',

        ]);

        $this->assertRedirectedTo('pages/home/edit');
        $this->assertSessionHas('error');
        $this->assertHasOldInput();
    }

    public function testUpdateHomeNav()
    {
        $this->markTestSkipped('Tests requiring authentication are currently broken.');

        $this->call('PATCH', 'pages/home', [
            'title'      => 'New Page',
            'nav_title'  => 'Herro',
            'slug'       => 'home',
            'icon'       => '',
            'body'       => 'Why herro there!',
            'css'        => '',
            'js'         => '',
            'show_title' => 'on',
            'show_nav'   => 'off',

        ]);

        $this->assertRedirectedTo('pages/home/edit');
        $this->assertSessionHas('error');
        $this->assertHasOldInput();
    }

    public function testUpdateSuccess()
    {
        $this->markTestSkipped('Tests requiring authentication are currently broken.');

        $this->call('PATCH', 'pages/home', [
            'title'      => 'New Page',
            'nav_title'  => 'Herro',
            'slug'       => 'home',
            'icon'       => '',
            'body'       => 'Why herro there!',
            'css'        => '',
            'js'         => '',
            'show_title' => 'on',
            'show_nav'   => 'on',

        ]);

        $this->assertRedirectedTo('pages/home');
        $this->assertSessionHas('success');
    }

    public function testDestroyFail()
    {
        $this->markTestSkipped('Tests requiring authentication are currently broken.');

        $this->call('DELETE', 'pages/home');

        $this->assertRedirectedTo('pages/home');
        $this->assertSessionHas('error');
    }

    public function testDestroySuccess()
    {
        $this->markTestSkipped('Tests requiring authentication are currently broken.');

        $this->call('DELETE', 'pages/about');

        $this->assertRedirectedTo('pages/home');
    }
}
