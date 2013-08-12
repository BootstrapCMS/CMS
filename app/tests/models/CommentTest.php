<?php

class CommentTest extends ModelTestCase implements IBelongsToUserTestCase {

    use TraitBelongsToUserTestCase;

    protected $model = 'Comment';

    protected function extraModelTests() {
        $this->assertInstanceOf('BaseModel', $this->object);
    }

    public function testGetBody() {
        $this->assertEquals($this->instance->getBody(), $this->instance->body);
    }

    public function testGetPostId() {
        $this->assertEquals($this->instance->getPostId(), $this->instance->post_id);
    }

    public function testRelationWithPost() {
        $this->assertEquals($this->instance->post->first(), $this->instance->getPost());
        $this->assertEquals($this->instance->post_id, $this->instance->getPost()->id);
    }

    public function testRelationWithPostId() {
        $this->assertEquals($this->instance->getPostId(), $this->instance->getPost()->id);
    }
}
