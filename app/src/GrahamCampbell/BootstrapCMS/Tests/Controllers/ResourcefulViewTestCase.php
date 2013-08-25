<?php namespace GrahamCampbell\BootstrapCMS\Tests\Controllers;

abstract class ResourcefulViewTestCase extends ControllerTestCase {

    public function testIndex() {
        $this->indexSetup();
        $this->indexMocking();
        $this->indexCall();
        $this->indexAssertions();
    }

    protected function indexSetup() {
        $this->setAsPage();
    }

    protected function indexMocking() {
        $provider = $this->provider;
        $provider::shouldReceive('paginate')
            ->once()->andReturn(array($this->mock));
        $provider::shouldReceive('links')
            ->once()->andReturn('');
    }

    protected function indexCall() {
        $this->call('GET', $this->getPath());
    }

    protected function indexAssertions() {
        $this->assertResponseOk();
    }

    public function testCreate() {
        $this->createSetup();
        $this->createMocking();
        $this->createCall();
        $this->createAssertions();
    }

    protected function createSetup() {
        $this->setAsPage();
    }

    protected function createMocking() {
        //
    }

    protected function createCall() {
        $this->call('GET', $this->getPath('create'));
    }

    protected function createAssertions() {
        $this->assertResponseOk();
    }

    public function testShow() {
        $this->showSetup();
        $this->showMocking();
        $this->showCall();
        $this->showAssertions();
    }

    protected function showSetup() {
        $this->setAsPage();
    }

    protected function showMocking() {
        $provider = $this->provider;
        $provider::shouldReceive('find')
            ->with($this->getUid())->once()->andReturn($this->mock);
    }

    protected function showCall() {
        $this->call('GET', $this->getPath($this->getUid()));
    }

    protected function showAssertions() {
        $this->assertResponseOk();
        $this->assertViewHas($this->view);
    }

    public function testEdit() {
        $this->editSetup();
        $this->editMocking();
        $this->editCall();
        $this->editAssertions();
    }

    protected function editSetup() {
        $this->setAsPage();
    }

    protected function editMocking() {
        $provider = $this->provider;
        $provider::shouldReceive('find')
            ->with($this->getUid())->once()->andReturn($this->mock);
    }

    protected function editCall() {
        $this->call('GET', $this->getPath($this->getUid().'/edit'));
    }

    protected function editAssertions() {
        $this->assertResponseOk();
        $this->assertViewHas($this->view);
    }
}
