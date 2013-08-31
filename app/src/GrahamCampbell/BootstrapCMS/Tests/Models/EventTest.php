<?php namespace GrahamCampbell\BootstrapCMS\Tests\Models;

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

use Carbon;

class EventTest extends ModelTestCase implements Relations\Interfaces\IBelongsToUserTestCase {

    use Relations\Common\TraitBelongsToUserTestCase;

    protected $model = 'GrahamCampbell\BootstrapCMS\Models\Event';

    protected function extraModelTests() {
        $this->assertInstanceOf('GrahamCampbell\BootstrapCMS\Models\BaseModel', $this->object);
    }

    public function testGetTitle() {
        $this->assertEquals($this->instance->getTitle(), $this->instance->title);
    }

    public function testGetDate() {
        $this->assertEquals($this->instance->getDate(), $this->instance->date);
    }

    public function testGetFormattedDate() {
        $date = new Carbon($this->instance->date);
        $formatteddate = $date->format('l jS F Y \\- H:i:s');
        $this->assertEquals($this->instance->getFormattedDate(), $formatteddate);
    }

    public function testGetLocation() {
        $this->assertEquals($this->instance->getLocation(), $this->instance->location);
    }

    public function testGetBody() {
        $this->assertEquals($this->instance->getBody(), $this->instance->body);
    }
}
