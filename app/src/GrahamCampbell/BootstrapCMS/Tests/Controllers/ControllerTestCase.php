<?php namespace GrahamCampbell\BootstrapCMS\Tests\Controllers;

use Validator;

use Carbon;
use Mockery;

use Navigation;
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
        Navigation::shouldReceive('get')->once()
            ->andReturn(array(
                array('slug' => 'pages/home', 'title' => 'Home', 'icon' => 'icon-home', 'active' => true),
                array('slug' => 'pages/about', 'title' => 'About', 'icon' => 'icon-info-sign', 'active' => false),
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
