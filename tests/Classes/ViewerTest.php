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

namespace GrahamCampbell\Tests\BootstrapCMS\Classes;

use Mockery;
use stdClass;
use GrahamCampbell\BootstrapCMS\Classes\Viewer;
use GrahamCampbell\TestBench\Classes\AbstractTestCase;

/**
 * This is the viewer test class.
 *
 * @package    Bootstrap-CMS
 * @author     Graham Campbell
 * @copyright  Copyright (C) 2013-2014  Graham Campbell
 * @license    https://github.com/GrahamCampbell/Bootstrap-CMS/blob/master/LICENSE.md
 * @link       https://github.com/GrahamCampbell/Bootstrap-CMS
 */
class ViewerTest extends AbstractTestCase
{
    public function testMakeSimple()
    {
        $viewer = $this->getViewer();
        $view = Mockery::mock('Illuminate\View\View');

        $viewer->getCredentials()->shouldReceive('check')->once()->andReturn(false);

        $nav = array('title' => 'Bootstrap CMS', 'inverse' => true);

        $viewer->getNavigation()->shouldReceive('getHTML')->once()
            ->with('default', false, $nav)->andReturn('html');

        $data = array('example' => 'qwerty', 'site_name' => 'Bootstrap CMS', 'navigation' => 'html');

        $viewer->getView()->shouldReceive('make')->once()
            ->with('test', $data)->andReturn($view);

        $return = $viewer->make('test', array('example' => 'qwerty'), 'default');

        $this->assertEquals($view, $return);
    }

    public function testMakeAccessDefault()
    {
        $viewer = $this->getViewer();
        $view = Mockery::mock('Illuminate\View\View');

        $viewer->getCredentials()->shouldReceive('check')->once()->andReturn(true);

        $user = new stdClass;
        $user->email = 'user@example.com';

        $viewer->getCredentials()->shouldReceive('getUser')->once()->andReturn($user);

        $nav = array('title' => 'Bootstrap CMS', 'side' => 'user@example.com', 'inverse' => true);

        $viewer->getNavigation()->shouldReceive('getHTML')->once()
            ->with('default', 'default', $nav)->andReturn('html');

        $data = array('example' => 'qwerty', 'site_name' => 'Bootstrap CMS', 'navigation' => 'html');

        $viewer->getView()->shouldReceive('make')->once()
            ->with('test', $data)->andReturn($view);

        $return = $viewer->make('test', array('example' => 'qwerty'), 'default');

        $this->assertEquals($view, $return);
    }

    public function testMakeAccessUser()
    {
        $viewer = $this->getViewer();
        $view = Mockery::mock('Illuminate\View\View');

        $viewer->getCredentials()->shouldReceive('check')->once()->andReturn(true);

        $viewer->getCredentials()->shouldReceive('hasAccess')->once()
            ->with('admin')->andReturn(false);

        $user = new stdClass;
        $user->email = 'user@example.com';

        $viewer->getCredentials()->shouldReceive('getUser')->once()->andReturn($user);

        $nav = array('title' => 'Bootstrap CMS', 'side' => 'user@example.com', 'inverse' => true);

        $viewer->getNavigation()->shouldReceive('getHTML')->once()
            ->with('default', 'default', $nav)->andReturn('html');

        $data = array('example' => 'qwerty', 'site_name' => 'Bootstrap CMS', 'navigation' => 'html');

        $viewer->getView()->shouldReceive('make')->once()
            ->with('test', $data)->andReturn($view);

        $return = $viewer->make('test', array('example' => 'qwerty'), 'admin');

        $this->assertEquals($view, $return);
    }

    public function testMakeAccessAdmin()
    {
        $viewer = $this->getViewer();
        $view = Mockery::mock('Illuminate\View\View');

        $viewer->getCredentials()->shouldReceive('check')->once()->andReturn(true);

        $viewer->getCredentials()->shouldReceive('hasAccess')->once()
            ->with('admin')->andReturn(true);

        $user = new stdClass;
        $user->email = 'user@example.com';

        $viewer->getCredentials()->shouldReceive('getUser')->once()->andReturn($user);

        $nav = array('title' => 'Admin Panel', 'side' => 'user@example.com', 'inverse' => true);

        $viewer->getNavigation()->shouldReceive('getHTML')->once()
            ->with('admin', 'admin', $nav)->andReturn('html');

        $data = array('example' => 'qwerty', 'site_name' => 'Admin Panel', 'navigation' => 'html');

        $viewer->getView()->shouldReceive('make')->once()
            ->with('test', $data)->andReturn($view);

        $return = $viewer->make('test', array('example' => 'qwerty'), 'admin');

        $this->assertEquals($view, $return);
    }

    protected function getViewer()
    {
        $view = Mockery::mock('Illuminate\View\Environment');
        $credentials = Mockery::mock('GrahamCampbell\Credentials\Classes\Credentials');
        $navigation = Mockery::mock('GrahamCampbell\Navigation\Classes\Navigation');
        $name = 'Bootstrap CMS';
        $inverse = true;

        return new Viewer($view, $credentials, $navigation, $name, $inverse);
    }
}
