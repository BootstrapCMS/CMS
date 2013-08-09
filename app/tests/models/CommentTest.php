<?php

class CommentTest extends ModelTestCase {

    protected $model = 'Comment';

    protected function extraModelTests() {
        $this->assertInstanceOf('BaseModel', $this->object);
    }

    public function testGetBody() {
        $this->assertEquals($this->instance->getBody(), $this->instance->body);
    }

    public function testGetUserId() {
        $this->assertEquals($this->instance->getUserId(), $this->instance->user_id);
    }

    public function testGetPostId() {
        $this->assertEquals($this->instance->getPostId(), $this->instance->post_id);
    }

    public function testRelationWithUser() {
        $this->assertEquals($this->instance->user->first(), $this->instance->getUser());
        $this->assertEquals($this->instance->user_id, $this->instance->getUser()->id);
    }

    public function testRelationWithUserId() {
        $this->assertEquals($this->instance->getUserId(), $this->instance->getUser()->id);
    }

    public function testRelationWithUserEmail() {
        $this->assertEquals($this->instance->getUserEmail(), $this->instance->getUser()->email);
    }

    public function testRelationWithUserName() {
        $this->assertEquals($this->instance->getUserName(), $this->instance->getUser()->first_name.' '.$this->instance->getUser()->last_name);
    }

    public function testRelationWithPost() {
        $this->assertEquals($this->instance->post->first(), $this->instance->getPost());
        $this->assertEquals($this->instance->post_id, $this->instance->getPost()->id);
    }

    public function testRelationWithPostId() {
        $this->assertEquals($this->instance->getPostId(), $this->instance->getPost()->id);
    }
}
