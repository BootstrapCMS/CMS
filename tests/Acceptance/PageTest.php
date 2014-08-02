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

/**
 * This is the page test class.
 *
 * @group acceptance
 *
 * @author    Graham Campbell <graham@mineuk.com>
 * @copyright 2013-2014 Graham Campbell
 * @license   <https://github.com/GrahamCampbell/Bootstrap-CMS/blob/master/LICENSE.md> AGPL 3.0
 */
class Pagetest extends AbstractTestCase
{
    public function testIndex()
    {
        $this->call('GET', '/');
        $this->assertRedirectedTo('pages/home');
    }

    // public function testCreate()
    // {
    //     $this->login();
    //     $this->call('PUT', 'pages/create', array());
    //     $this->assertRedirectedTo('pages/create');
    // }

    public function testShowHome()
    {
        $this->call('GET', 'pages/home');
        $this->assertResponseOk();
        $this->assertSee('Bootstrap CMS');
    }

    public function testShowAbout()
    {
        $this->call('GET', 'pages/about');
        $this->assertResponseOk();
        $this->assertSee('This is the about page!');
    }
}
