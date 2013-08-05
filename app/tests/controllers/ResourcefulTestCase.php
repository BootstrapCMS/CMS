<?php

abstract class ResourcefulTestCase extends ControllerTestCase {

    public function testIndex() {
        $this->setAsPage();
        
        $this->call('GET', $this->getPath());

        $this->assertResponseOk();
    }

    public function testCreate() {
        $this->setAsPage();

        $this->call('GET', $this->getPath('create'));

        $this->assertResponseOk();
    }

    public function testStore() {
        $this->validate(true);
        $this->mock->shouldReceive('create')
            ->once()->andReturn($this->mock);
        

        $this->call('POST', $this->getPath());

        $this->assertRedirectedToRoute($this->getRoute('show'), $this->getRoutePram($this->getUid()));
        $this->assertSessionHas('success');
    }

    public function testStoreFails() {
        $this->validate(false);

        $this->call('POST', $this->getPath());

        $this->assertRedirectedToRoute($this->getRoute('create'));
        $this->assertSessionHasErrors();
    }

    public function testShow() {
        $this->setAsPage();

        $this->mock->shouldReceive($this->getFind())
            ->with($this->getUid())->once()->andReturn($this->mock);

        $this->call('GET', $this->getPath($this->getUid()));

        $this->assertResponseOk();

        $this->assertViewHas(strtolower($this->model));
    }

    public function testEdit() {
        $this->setAsPage();

        $this->mock->shouldReceive($this->getFind())
            ->with($this->getUid())->once()->andReturn($this->mock);

        $this->call('GET', $this->getPath($this->getUid().'/edit'));

        $this->assertResponseOk();

        $this->assertViewHas(strtolower($this->model));
    }

    public function testUpdate() {
        $this->validate(true);
        $this->mock->shouldReceive($this->getFind())
            ->with($this->getUid())->once()->andReturn($this->mock);
        $this->mock->shouldReceive('update')->once();

        $this->call('PATCH', $this->getPath($this->getUid()));

        $this->assertRedirectedToRoute($this->getRoute('show'), $this->getRoutePram($this->getUid()));
        $this->assertSessionHas('success');
    }

    public function testUpdateFails() {
        $this->validate(false);

        $this->call('PATCH', $this->getPath($this->getUid()));

        $this->assertRedirectedTo($this->getPath($this->getUid().'/edit'));
        $this->assertSessionHasErrors();
    }

    public function testDestroy() {
        $this->mock->shouldReceive($this->getFind())
            ->with($this->getUid())->once()->andReturn($this->mock);
        $this->mock->shouldReceive('delete')->once();

        $this->call('DELETE', $this->getPath($this->getUid()));

        $this->assertRedirectedToRoute($this->getRoute('index'));
    }
}