<?php

use Way\Tests\Factory;

abstract class ControllerTestCase extends TestCase {

    protected $model; // must be set in the extending class

    protected $mock;

    protected $attributes;

    public function setUp() {
        parent::setUp();

        $this->mock = Mockery::mock($this->model);

        $model = new $this->model;
        $this->attributes = $model->factory;

        $this->app->instance($this->model, $this->mock);

        $this->addLinks(array(
            'getId'        => 'id',
            'getCreatedAt' => 'created_at',
            'getUpdatedAt' => 'updated_at',
        ));
    }

    public function tearDown() {
        Mockery::close();
    }

    public function setAsPage() {
        $this->shouldReceive('getNav')->once()->andReturn(array());
    }

    protected function validate($bool) {
        Validator::shouldReceive('make')->once()
            ->andReturn(Mockery::mock(array('passes' => $bool, 'fails' => !$bool, 'errors' => array())));
    }

    protected function shouldReceive() {
        return call_user_func_array(array($this->mock, 'shouldReceive'), func_get_args());
    }

    protected function addLink($name, $attribute) {
        $this->shouldReceive($name)
            ->andReturn($this->attributes[$attribute]);
    }

    protected function addLinks($array) {
        foreach ($array as $key => $value) {
            $this->addLink($key, $value);
        }
    }

    public function testMocking() {
        $this->assertNotNull($this->model);
        $this->assertNotNull($this->mock);
        $this->assertNotNull($this->attributes);

        $this->assertEquals($this->mock->getId(), $this->attributes['id']);
        $this->assertEquals($this->mock->getCreatedAt(), $this->attributes['created_at']);
        $this->assertEquals($this->mock->getUpdatedAt(), $this->attributes['updated_at']);
    }
}
