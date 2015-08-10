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
        $this->visit('/')->seePageIs('pages/home');
    }

    public function testCreate()
    {
        $this->markTestSkipped('Tests requiring authentication are currently broken.');

        $this->visit('pages/create')->see('Create Page');
    }

    public function testStoreFail()
    {
        $this->markTestSkipped('Tests requiring authentication are currently broken.');

        Credentials::shouldReceive('getuser')->once()->andReturn((object) ['id' => 1]);

        $this->post('pages');

        $this->assertRedirectedTo('pages/create');
        $this->assertSessionHasErrors();
        $this->assertHasOldInput();
    }

    public function testStoreSuccess()
    {
        $this->markTestSkipped('Tests requiring authentication are currently broken.');

        Credentials::shouldReceive('getuser')->once()->andReturn((object) ['id' => 1]);

        $this->post('pages', [
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

    public function testShowFail()
    {
        $this->get('pages/error');

        $this->assertEquals(404, $this->response->status());
    }

    public function testShowSuccess()
    {
        $this->visit('pages/home')->see('Bootstrap CMS');
    }

    public function testEditHome()
    {
        $this->markTestSkipped('Tests requiring authentication are currently broken.');

        $this->visit('pages/home/edit')->see('Edit Welcome');
    }

    public function testUpdateFail()
    {
        $this->markTestSkipped('Tests requiring authentication are currently broken.');

        $this->patch('pages/home');

        $this->assertRedirectedTo('pages/home/edit');
        $this->assertSessionHasErrors();
        $this->assertHasOldInput();
    }

    public function testUpdateHomeUrl()
    {
        $this->markTestSkipped('Tests requiring authentication are currently broken.');

        $this->patch('pages/home', [
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

        $this->patch('pages/home', [
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

        $this->patch('pages/home', [
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

        $this->delete('pages/home');

        $this->assertRedirectedTo('pages/home');
        $this->assertSessionHas('error');
    }

    public function testDestroySuccess()
    {
        $this->markTestSkipped('Tests requiring authentication are currently broken.');

        $this->delete('pages/about');

        $this->assertRedirectedTo('pages/home');
    }
}
