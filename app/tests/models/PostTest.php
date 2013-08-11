<?php

class PostTest extends ModelTestCase implements IBelongsToUserTestCase {

    use TraitBelongsToUserTestCase;

    protected $model = 'Post';

    protected function extraModelTests() {
        $this->assertInstanceOf('BaseModel', $this->object);
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
