<?php namespace GrahamCampbell\BootstrapCMS\Tests\Models;

class CommentTest extends ModelTestCase implements Relations\Interfaces\IBelongsToUserTestCase {

    use Relations\Common\TraitBelongsToUserTestCase;

    protected $model = 'GrahamCampbell\BootstrapCMS\Models\Comment';

    protected function extraModelTests() {
        $this->assertInstanceOf('GrahamCampbell\BootstrapCMS\Models\BaseModel', $this->object);
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
