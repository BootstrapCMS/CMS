<?php

class PageTest extends ModelTestCase {

    protected $model = 'Page';

    protected function extraModelTests() {
        $this->assertInstanceOf('BaseModel', $this->object);
    }

    public function testFindBySlug() {
        $this->assertEquals($this->object->findBySlug($this->instance->slug), $this->instance);
    }

    public function testGetTitle() {
        $this->assertEquals($this->instance->getTitle(), $this->instance->title);
    }

    public function testGetSlug() {
        $this->assertEquals($this->instance->getSlug(), $this->instance->slug);
    }

    public function testGetBody() {
        $this->assertEquals($this->instance->getBody(), $this->instance->body);
    }

    public function testGetShowTitle() {
        $this->assertEquals($this->instance->getShowTitle(), $this->instance->show_title);
    }

    public function testGetShowNav() {
        $this->assertEquals($this->instance->getShowNav(), $this->instance->show_nav);
    }

    public function testGetIcon() {
        $this->assertEquals($this->instance->getIcon(), $this->instance->icon);
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

    // TODO: test nav menu logic
}
