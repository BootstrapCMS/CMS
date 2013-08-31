<?php namespace GrahamCampbell\BootstrapCMS\Tests\Models\Relations\Common;

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

trait TraitBelongsToUserTestCase {

    public function testGetUserId() {
        $this->assertEquals($this->instance->getUserId(), $this->instance->user_id);
    }

    public function testRelationWithUser() {
        $this->assertEquals($this->instance->user->first(), $this->instance->getUser());
        $this->assertEquals($this->instance->user_id, $this->instance->getUser()->id);
    }

    public function testRelationWithUserId() {
        $this->assertEquals($this->instance->getUserId(), $this->instance->getUser()->id);
    }

    public function testRelationWithUserEmail() {
        $this->assertEquals($this->instance->getUserEmail(), $this->instance->getUser()->email);
    }

    public function testRelationWithUserName() {
        $this->assertEquals($this->instance->getUserName(), $this->instance->getUser()->first_name.' '.$this->instance->getUser()->last_name);
    }
}
