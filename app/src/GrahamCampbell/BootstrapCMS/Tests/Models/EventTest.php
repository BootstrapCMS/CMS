<?php namespace GrahamCampbell\BootstrapCMS\Tests\Models;

use Carbon;

class EventTest extends ModelTestCase implements Relations\Interfaces\IBelongsToUserTestCase {

    use Relations\Common\TraitBelongsToUserTestCase;

    protected $model = 'GrahamCampbell\BootstrapCMS\Models\Event';

    protected function extraModelTests() {
        $this->assertInstanceOf('GrahamCampbell\BootstrapCMS\Models\BaseModel', $this->object);
    }

    public function testGetTitle() {
        $this->assertEquals($this->instance->getTitle(), $this->instance->title);
    }

    public function testGetDate() {
        $this->assertEquals($this->instance->getDate(), $this->instance->date);
    }

    public function testGetFormattedDate() {
        $date = new Carbon($this->instance->date);
        $formatteddate = $date->format('l jS F Y \\- H:i:s');
        $this->assertEquals($this->instance->getFormattedDate(), $formatteddate);
    }

    public function testGetLocation() {
        $this->assertEquals($this->instance->getLocation(), $this->instance->location);
    }

    public function testGetBody() {
        $this->assertEquals($this->instance->getBody(), $this->instance->body);
    }
}
