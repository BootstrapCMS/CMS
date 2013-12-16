<?php namespace GrahamCampbell\BootstrapCMS\Tests\Controllers;

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
 *
 * @package    Bootstrap-CMS
 * @author     Graham Campbell
 * @license    GNU AFFERO GENERAL PUBLIC LICENSE
 * @copyright  Copyright (C) 2013  Graham Campbell
 * @link       https://github.com/GrahamCampbell/Bootstrap-CMS
 */

abstract class ResourcefulViewTestCase extends ControllerTestCase {

    public function testIndex() {
        $this->indexSetup();
        $this->indexMocking();
        $this->indexCall();
        $this->indexAssertions();
    }

    protected function indexSetup() {
        $this->setAsPage();
    }

    protected function indexMocking() {
        $provider = $this->provider;
        $provider::shouldReceive('paginate')
            ->once()->andReturn(array($this->mock));
        $provider::shouldReceive('links')
            ->once()->andReturn('');
    }

    protected function indexCall() {
        $this->call('GET', $this->getPath());
    }

    protected function indexAssertions() {
        $this->assertResponseOk();
    }

    public function testCreate() {
        $this->createSetup();
        $this->createMocking();
        $this->createCall();
        $this->createAssertions();
    }

    protected function createSetup() {
        $this->setAsPage();
    }

    protected function createMocking() {
        //
    }

    protected function createCall() {
        $this->call('GET', $this->getPath('create'));
    }

    protected function createAssertions() {
        $this->assertResponseOk();
    }

    public function testShow() {
        $this->showSetup();
        $this->showMocking();
        $this->showCall();
        $this->showAssertions();
    }

    protected function showSetup() {
        $this->setAsPage();
    }

    protected function showMocking() {
        $provider = $this->provider;
        $provider::shouldReceive('find')
            ->with($this->getUid())->once()->andReturn($this->mock);
    }

    protected function showCall() {
        $this->call('GET', $this->getPath($this->getUid()));
    }

    protected function showAssertions() {
        $this->assertResponseOk();
        $this->assertViewHas($this->view);
    }

    public function testEdit() {
        $this->editSetup();
        $this->editMocking();
        $this->editCall();
        $this->editAssertions();
    }

    protected function editSetup() {
        $this->setAsPage();
    }

    protected function editMocking() {
        $provider = $this->provider;
        $provider::shouldReceive('find')
            ->with($this->getUid())->once()->andReturn($this->mock);
    }

    protected function editCall() {
        $this->call('GET', $this->getPath($this->getUid().'/edit'));
    }

    protected function editAssertions() {
        $this->assertResponseOk();
        $this->assertViewHas($this->view);
    }
}
