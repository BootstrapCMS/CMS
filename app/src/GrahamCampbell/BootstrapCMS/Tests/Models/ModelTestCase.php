<?php namespace GrahamCampbell\BootstrapCMS\Tests\Models;

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
