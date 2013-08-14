<?php namespace GrahamCampbell\BootstrapCMS\Tests\Models\Relations\Common;

trait TraitBelongsToUserTestCase {

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
}
