<?php namespace GrahamCampbell\BootstrapCMS\Tests\Controllers;

use Mockery;

class PostControllerViewTest extends ResourcefulViewTestCase {

    use PostControllerSetupTrait;

    protected function showMocking() {
        $provider = $this->provider;
        $provider::shouldReceive('find')
            ->with($this->getUid())->once()->andReturn($this->mock);
        $this->mock->shouldReceive('getUserName')
            ->once()->andReturn('name');
        $this->mock->shouldReceive('getComments')
            ->once()->andReturn(array());
    }
}
