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

class CommentControllerActionTest extends ResourcefulActionTestCase {

    use CommentControllerSetupTrait;

    protected function storeCall() {
        $this->call('POST', $this->getPath($this->getUid().'/comments'));
        $this->assertResponseStatus(405);

        $this->call('POST', $this->getPath($this->getUid().'/comments'), array(), array(), array('HTTP_X-Requested-With' => 'XMLHttpRequest'));
        $this->assertResponseOk();
    }

    protected function storeFailsAssertions() {
        // TODO: Check the json response
    }

    protected function updateCall() {
        $this->call('PATCH', $this->getPath($this->getUid().'/comments/'.$this->getUid()));
        $this->assertResponseStatus(405);

        $this->call('PATCH', $this->getPath($this->getUid().'/comments/'.$this->getUid()), array(), array(), array('HTTP_X-Requested-With' => 'XMLHttpRequest'));
        $this->assertResponseOk();
    }

    protected function updateFailsAssertions() {
        // TODO: Check the json response
    }

    protected function destroyCall() {
        $this->call('DELETE', $this->getPath($this->getUid().'/comments/'.$this->getUid()));
        $this->assertResponseStatus(405);

        $this->call('DELETE', $this->getPath($this->getUid().'/comments/'.$this->getUid()), array(), array(), array('HTTP_X-Requested-With' => 'XMLHttpRequest'));
        $this->assertResponseOk();
    }

    protected function destroyAssertions() {
        // TODO: Check the json response
    }
}
