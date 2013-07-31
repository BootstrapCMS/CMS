<?php

use Way\Tests\Factory;

abstract class ControllerTestCase extends TestCase {

    protected $model; // must be set in the extending class

    protected $mock;
    protected $collection;

    protected $attributes;
    protected $factory;

    public function setUp() {
        parent::setUp();

        $this->mock = Mockery::mock('Eloquent', $this->model);
        $this->collection = Mockery::mock('Illuminate\Database\Eloquent\Collection')->shouldDeferMissing();

        $model = new $this->model;
        $this->attributes = Factory::attributesFor($this->model, $model->factory);
        $this->factory = Factory::make($this->model, $this->attributes);

        $this->app->instance($this->model, $this->mock);
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
        return call_user_func_array([$this->mock, 'shouldReceive'], func_get_args());
    }
}
