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

use Validator;

use Carbon;
use Mockery;

use PageProvider;
use GrahamCampbell\BootstrapCMS\Tests\TestCase;

abstract class ControllerTestCase extends TestCase {

    // protected $model; // must be set in the extending class
    // protected $provider; // must be set in the extending class
    // protected $view; // must be set in the extending class
    // protected $name; // must be set in the extending class
    // protected $base; // must be set in the extending class
    // protected $uid; // must be set in the extending class

    protected $mock;

    protected $attributes;

    public function setUp() {
        parent::setUp();

        $model = $this->model;

        $this->mock = Mockery::mock($model);
        $this->app->instance($model, $this->mock);

        $this->attributes = $model::$factory;
        $this->attributes['created_at'] = Carbon::createFromTimeStamp(1234567890);
        $this->attributes['updated_at'] = Carbon::createFromTimeStamp(1234567890);

        $this->setUpLinks();
    }

    public function setUpLinks() {
        $this->addLinks(array(
            'getId'        => 'id',
            'getCreatedAt' => 'created_at',
            'getUpdatedAt' => 'updated_at',
        ));

        $this->extraLinks();
    }

    protected function extraLinks() {
        // can be set in the extending class
    }

    protected function addLink($name, $attribute) {
        $this->mock->shouldReceive($name)
            ->andReturn($this->attributes[$attribute]);
    }

    protected function addLinks($links) {
        foreach ($links as $name => $attribute) {
            $this->addLink($name, $attribute);
        }
    }

    public function tearDown() {
        Mockery::close();
    }

    protected function setAsPage() {
        PageProvider::shouldReceive('addMain')->twice();
        PageProvider::shouldReceive('navigation')->once()
            ->andReturn(array(
                array('url' => 'http://localhost/pages/home', 'title' => 'Home', 'icon' => 'fa fa-home', 'active' => true),
                array('url' => 'http://localhost/pages/about', 'title' => 'About', 'icon' => 'fa fa-info-circle', 'active' => false)
        ));
    }

    protected function validate($bool) {
        Validator::shouldReceive('make')->once()
            ->andReturn(Mockery::mock(array('passes' => $bool, 'fails' => !$bool, 'errors' => array())));
    }

    protected function getUid() {
        return $this->attributes[$this->uid];
    }

    protected function getPath($path = null) {
        if (!$path) {
            return str_replace('.', '/', $this->base);
        } else {
            return str_replace('.', '/', $this->base).'/'.$path;
        }
    }

    protected function getRoute($route = null) {
        if (!$route) {
            return $this->base;
        } else {
            return $this->base.'.'.$route;
        }
    }

    protected function getRoutePram($pram) {
        return array($this->name => $pram);
    }

    public function testMocking() {
        $this->assertNotNull($this->model);
        $this->assertNotNull($this->base);
        $this->assertNotNull($this->mock);
        $this->assertNotNull($this->attributes);

        $this->assertEquals($this->mock->getId(), $this->attributes['id']);
        $this->assertEquals($this->mock->getCreatedAt(), $this->attributes['created_at']);
        $this->assertEquals($this->mock->getUpdatedAt(), $this->attributes['updated_at']);

        $this->extraMockingTests();
    }

    protected function extraMockingTests() {
        // can be set in the extending class
        // these tests are optional, so this function is not abstract
    }
}
