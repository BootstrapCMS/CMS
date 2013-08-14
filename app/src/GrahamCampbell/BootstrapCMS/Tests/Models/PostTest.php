<?php namespace GrahamCampbell\BootstrapCMS\Tests\Models;

class PostTest extends ModelTestCase implements Relations\Interfaces\IBelongsToUserTestCase {

    use Relations\Common\TraitBelongsToUserTestCase;

    protected $model = 'GrahamCampbell\BootstrapCMS\Models\Post';

    protected function extraModelTests() {
        $this->assertInstanceOf('GrahamCampbell\BootstrapCMS\Models\BaseModel', $this->object);
    }

    public function testGetTitle() {
        $this->assertEquals($this->instance->getTitle(), $this->instance->title);
    }

    public function testGetSummary() {
        $this->assertEquals($this->instance->getSummary(), $this->instance->summary);
    }

    public function testGetBody() {
        $this->assertEquals($this->instance->getBody(), $this->instance->body);
    }

    // TODO: test comment relationships
}
