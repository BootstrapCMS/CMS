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

namespace GrahamCampbell\Tests\BootstrapCMS\Controllers;

use Mockery;
use GrahamCampbell\CMSCore\Facades\PostProvider;

/**
 * This is the comment controller view test class.
 *
 * @package    Bootstrap-CMS
 * @author     Graham Campbell
 * @copyright  Copyright (C) 2013-2014  Graham Campbell
 * @license    https://github.com/GrahamCampbell/Bootstrap-CMS/blob/master/LICENSE.md
 * @link       https://github.com/GrahamCampbell/Bootstrap-CMS
 */
class CommentControllerViewTest extends AbstractResourcefulViewTestCase
{
    use CommentControllerSetupTrait;

    protected function indexSetup()
    {
        // overwritten to cancel it
    }

    protected function indexMocking()
    {
        PostProvider::shouldReceive('find')
            ->once()->andReturn($this->mock);
        $this->mock->shouldReceive('getComments')
            ->once()->andReturn(array($this->mock));
    }

    protected function indexCall()
    {
        $this->call('GET', $this->getPath($this->getUid().'/comments'), array(), array(), array('HTTP_X-Requested-With' => 'XMLHttpRequest'));
    }

    protected function storeAssertions()
    {
        $this->assertResponseOk();
    }

    public function testCreate()
    {
        // overwritten to cancel it
    }

    protected function showSetup()
    {
        // overwritten to cancel it
    }

    protected function showMocking()
    {
        $provider = $this->provider;
        $provider::shouldReceive('find')
            ->with($this->getUid())->once()->andReturn($this->mock);
        $this->mock->shouldReceive('getUserName')->once();
    }

    protected function showCall()
    {
        $this->call('GET', $this->getPath($this->getUid().'/comments/'.$this->getUid()), array(), array(), array('HTTP_X-Requested-With' => 'XMLHttpRequest'));
    }

    protected function showAssertions()
    {
        $this->assertResponseOk();
    }

    public function testEdit()
    {
        // overwritten to cancel it
    }
}
