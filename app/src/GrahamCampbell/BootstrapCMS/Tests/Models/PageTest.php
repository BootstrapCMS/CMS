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

class PageTest extends ModelTestCase implements Relations\Interfaces\IBelongsToUserTestCase {

    use Relations\Common\TraitBelongsToUserTestCase;

    protected $model = 'GrahamCampbell\BootstrapCMS\Models\Page';

    protected function extraModelTests() {
        $this->assertInstanceOf('GrahamCampbell\BootstrapCMS\Models\BaseModel', $this->object);
    }

    public function testGetTitle() {
        $this->assertEquals($this->instance->getTitle(), $this->instance->title);
    }

    public function testGetSlug() {
        $this->assertEquals($this->instance->getSlug(), $this->instance->slug);
    }

    public function testGetBody() {
        $this->assertEquals($this->instance->getBody(), $this->instance->body);
    }

    public function testGetShowTitle() {
        $this->assertEquals($this->instance->getShowTitle(), $this->instance->show_title);
    }

    public function testGetShowNav() {
        $this->assertEquals($this->instance->getShowNav(), $this->instance->show_nav);
    }

    public function testGetIcon() {
        $this->assertEquals($this->instance->getIcon(), $this->instance->icon);
    }

    // TODO: test nav menu logic
}
