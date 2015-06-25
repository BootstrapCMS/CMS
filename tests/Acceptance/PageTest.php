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

use GrahamCampbell\Credentials\Facades\Credentials;

/**
 * This is the page test class.
 *
 * @group page
 *
 * @author Graham Campbell <graham@alt-three.com>
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
