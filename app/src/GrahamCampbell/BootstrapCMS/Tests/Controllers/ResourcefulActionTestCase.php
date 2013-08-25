<?php namespace GrahamCampbell\BootstrapCMS\Tests\Controllers;

abstract class ResourcefulActionTestCase extends ControllerTestCase {

    public function testStore() {
        $this->storeSetup();
        $this->storeMocking();
        $this->storeCall();
        $this->storeAssertions();
    }

    protected function storeSetup() {
        $this->validate(true);
    }

    protected function storeMocking() {
        $provider = $this->provider;
        $provider::shouldReceive('create')
            ->once()->andReturn($this->mock);
    }

    protected function storeCall() {
        $this->call('POST', $this->getPath());
    }

    protected function storeAssertions() {
        $this->assertRedirectedToRoute($this->getRoute('show'), $this->getRoutePram($this->getUid()));
        $this->assertSessionHas('success');
    }

    public function testStoreFails() {
        $this->storeFailsSetup();
        $this->storeFailsMocking();
        $this->storeFailsCall();
        $this->storeFailsAssertions();
    }

    protected function storeFailsSetup() {
        $this->validate(false);
    }

    protected function storeFailsMocking() {
        //
    }

    protected function storeFailsCall() {
        $this->storeCall();
    }

    protected function storeFailsAssertions() {
        $this->assertRedirectedToRoute($this->getRoute('create'));
        $this->assertSessionHasErrors();
    }

    public function testUpdate() {
        $this->updateSetup();
        $this->updateMocking();
        $this->updateCall();
        $this->updateAssertions();
    }

    protected function updateSetup() {
        $this->validate(true);
    }

    protected function updateMocking() {
        $provider = $this->provider;
        $provider::shouldReceive('find')
            ->with($this->getUid())->once()->andReturn($this->mock);
        $this->mock->shouldReceive('update')->once();
    }

    protected function updateCall() {
        $this->call('PATCH', $this->getPath($this->getUid()));
    }

    protected function updateAssertions() {
        $this->assertRedirectedToRoute($this->getRoute('show'), $this->getRoutePram($this->getUid()));
        $this->assertSessionHas('success');
    }

    public function testUpdateFails() {
        $this->updateFailsSetup();
        $this->updateFailsMocking();
        $this->updateFailsCall();
        $this->updateFailsAssertions();
    }

    protected function updateFailsSetup() {
        $this->validate(false);
    }

    protected function updateFailsMocking() {
        //
    }

    protected function updateFailsCall() {
        $this->updateCall();
    }

    protected function updateFailsAssertions() {
        $this->assertRedirectedTo($this->getPath($this->getUid().'/edit'));
        $this->assertSessionHasErrors();
    }

    public function testDestroy() {
        $this->destroySetup();
        $this->destroyMocking();
        $this->destroyCall();
        $this->destroyAssertions();
    }

    protected function destroySetup() {
        //
    }

    protected function destroyMocking() {
        $provider = $this->provider;
        $provider::shouldReceive('find')
            ->with($this->getUid())->once()->andReturn($this->mock);
        $this->mock->shouldReceive('delete')->once();
    }

    protected function destroyCall() {
        $this->call('DELETE', $this->getPath($this->getUid()));
    }

    protected function destroyAssertions() {
        $this->assertRedirectedToRoute($this->getRoute('index'));
    }
}
