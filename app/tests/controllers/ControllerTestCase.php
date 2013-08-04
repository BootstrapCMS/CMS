<?php

use Way\Tests\Factory;
use Carbon\Carbon;

abstract class ControllerTestCase extends TestCase {

    protected $model; // must be set in the extending class
    protected $name; // must be set in the extending class
    protected $base; // must be set in the extending class
    protected $uid; // must be set in the extending class

    protected $mock;
    protected $pagemock;

    protected $attributes;

    public function setUp() {
        parent::setUp();

        $this->mock = Mockery::mock($this->model);
        $this->app->instance($this->model, $this->mock);

        $model = new $this->model;
        $this->attributes = $model->factory;
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

    public function setAsPage() {
        $nav = array(
            array(
                'title' => 'Home',
                'slug' => 'home',
                'icon' => 'icon-home',
            ),
            array(
                'title' => 'About',
                'slug' => 'about',
                'icon' => 'icon-info-sign',
            ),
        );
        if ($this->model != 'Page') {
            $this->pagemock = Mockery::mock('Page');
            $this->app->instance('Page', $this->pagemock);

            $this->pagemock->shouldReceive('getNav')->once()->andReturn($nav);
        } else {
            $this->mock->shouldReceive('getNav')->once()->andReturn($nav);
        }
    }

    protected function validate($bool) {
        Validator::shouldReceive('make')->once()
            ->andReturn(Mockery::mock(array('passes' => $bool, 'fails' => !$bool, 'errors' => array())));
    }

    protected function getUid() {
        return $this->attributes[$this->uid];
    }

    protected function getFind() {
        if ($this->uid == 'id') {
            return 'find';
        } else {
            return 'findBy'.ucfirst($this->uid);
        }
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

    public function getRoutePram($pram) {
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
    }
}
