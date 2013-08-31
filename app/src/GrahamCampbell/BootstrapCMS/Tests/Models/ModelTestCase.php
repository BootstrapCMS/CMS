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

use Artisan;

use GrahamCampbell\BootstrapCMS\Tests\TestCase;

abstract class ModelTestCase extends TestCase {

    protected $model; // must be set in the extending class

    protected $object;
    protected $instance;

    public function setUp() {
        parent::setUp();

        Artisan::call('migrate', array('--package' => 'cartalyst/sentry'));
        Artisan::call('migrate', array('--seed' => true));

        $this->object = new $this->model;
        $this->instance = $this->object->find(1);
    }

    public function testModel() {
        $this->assertClassHasAttribute('table', $this->model);
        $this->assertClassHasAttribute('guarded', $this->model);
        $this->assertInstanceOf($this->model, $this->object);
        $this->assertInstanceOf('Eloquent', $this->object);

        $this->extraModelTests();
    }

    protected function extraModelTests() {
        // can be set in the extending class
    }

    public function testGetId() {
        $this->assertEquals($this->instance->getId(), $this->instance->id);
    }

    public function testGetCreatedAt() {
        $this->assertEquals($this->instance->getCreatedAt(), $this->instance->created_at);
    }

    public function testGetUpdatedAt() {
        $this->assertEquals($this->instance->getUpdatedAt(), $this->instance->updated_at);
    }
}
