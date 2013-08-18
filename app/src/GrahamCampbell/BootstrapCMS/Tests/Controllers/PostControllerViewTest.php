<?php namespace GrahamCampbell\BootstrapCMS\Tests\Controllers;

use Mockery;

class PostControllerViewTest extends ResourcefulViewTestCase {

    use PostControllerSetupTrait;

    protected function indexMocking() {
        $this->mock->shouldReceive('orderBy')
            ->once()->andReturn(Mockery::mock(array('get' => array($this->mock))));
    }

    protected function showMocking() {
        $provider = $this->provider;
        $provider::shouldReceive($this->getFind())
            ->with($this->getUid())->once()->andReturn($this->mock);
        $this->mock->shouldReceive('getUserName')
            ->once()->andReturn('name');
        $this->mock->shouldReceive('getCommentsReversed')
            ->once()->andReturn(array());
    }
}
