<?php

class PostTest extends ModelTestCase {

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

    public function testGetUserId() {
        $this->assertEquals($this->instance->getUserId(), $this->instance->user_id);
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

    // TODO: test comment relationships
}
