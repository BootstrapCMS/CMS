<?php

class PageTest extends ModelTestCase implements IBelongsToUserTestCase {

    use TraitBelongsToUserTestCase;

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

    // TODO: test nav menu logic
}
