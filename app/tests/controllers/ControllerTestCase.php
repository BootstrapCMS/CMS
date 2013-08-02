<?php

use Way\Tests\Factory;
use Carbon\Carbon;

abstract class ControllerTestCase extends TestCase {

    protected $model; // must be set in the extending class

    protected $mock;

    protected $attributes;

    public function setUp() {
        parent::setUp();

        $this->mock = Mockery::mock($this->model);

        $model = new $this->model;
        $this->attributes = $model->factory;
        $this->attributes['created_at'] = Carbon::createFromTimeStamp(1234567890);
        $this->attributes['updated_at'] = Carbon::createFromTimeStamp(1234567890);

        $this->app->instance($this->model, $this->mock);

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
        $this->shouldReceive($name)
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
        $this->shouldReceive('getNav')->once()->andReturn(array());
    }

    protected function validate($bool) {
        Validator::shouldReceive('make')->once()
            ->andReturn(Mockery::mock(array('passes' => $bool, 'fails' => !$bool, 'errors' => array())));
    }

    protected function shouldReceive() {
        return call_user_func_array(array($this->mock, 'shouldReceive'), func_get_args());
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
