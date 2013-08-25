<?php namespace GrahamCampbell\BootstrapCMS\Tests\Models;

class PageTest extends ModelTestCase implements Relations\Interfaces\IBelongsToUserTestCase {

    use Relations\Common\TraitBelongsToUserTestCase;

    protected $model = 'GrahamCampbell\BootstrapCMS\Models\Page';

    protected function extraModelTests() {
        $this->assertInstanceOf('GrahamCampbell\BootstrapCMS\Models\BaseModel', $this->object);
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
