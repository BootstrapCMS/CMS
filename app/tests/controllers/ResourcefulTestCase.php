<?php

abstract class ResourcefulTestCase extends ControllerTestCase {

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
        //
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
        $this->mock->shouldReceive('create')
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
        $this->mock->shouldReceive($this->getFind())
            ->with($this->getUid())->once()->andReturn($this->mock);
    }

    protected function showCall() {
        $this->call('GET', $this->getPath($this->getUid()));
    }

    protected function showAssertions() {
        $this->assertResponseOk();
        $this->assertViewHas(strtolower($this->model));
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
        $this->mock->shouldReceive($this->getFind())
            ->with($this->getUid())->once()->andReturn($this->mock);
    }

    protected function editCall() {
        $this->call('GET', $this->getPath($this->getUid().'/edit'));
    }

    protected function editAssertions() {
        $this->assertResponseOk();
        $this->assertViewHas(strtolower($this->model));
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
        $this->mock->shouldReceive($this->getFind())
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
        $this->mock->shouldReceive($this->getFind())
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
