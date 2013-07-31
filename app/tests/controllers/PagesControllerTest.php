<?php

class PagesControllerTest extends ControllerTestCase {

    protected $model = 'Page';

    public function testIndex() {
        $this->call('GET', 'pages');

        $this->assertRedirectedToRoute('pages.show', array('pages' => 'home'));
    }

    public function testCreate() {
        $this->setAsPage();

        $this->call('GET', 'pages/create');

        $this->assertResponseOk();
    }

    public function testStore() {
        $this->validate(true);
        $this->shouldReceive('create')->once()->andReturn($this->factory);

        $this->call('POST', 'pages');

        $this->assertRedirectedToRoute('pages.show', array('pages' => $this->attributes['slug']));
        $this->assertSessionHas('success');
    }

    public function testStoreFails() {
        $this->validate(false);

        $this->call('POST', 'pages');

        $this->assertRedirectedToRoute('pages.create');
        $this->assertSessionHasErrors();
    }

    public function testShow() {
        $this->setAsPage();

        $this->shouldReceive('findBySlug')->with($this->attributes['slug'])->once()->andReturn($this->factory);

        $this->call('GET', 'pages/'.$this->attributes['slug']);

        $this->assertResponseOk();

        $this->assertViewHas('page');
    }

    // public function testEdit() {
    //     $this->collection->id = 1;
    //     $this->mock->shouldReceive('find')
    //                ->with(1)
    //                ->once()
    //                ->andReturn($this->collection);

    //     $this->call('GET', 'pages/1/edit');

    //     $this->assertViewHas('page');
    // }

    // public function testUpdate() {
    //     $this->mock->shouldReceive('find')
    //                ->with(1)
    //                ->andReturn(Mockery::mock(['update' => true]));

    //     $this->validate(true);
    //     $this->call('PATCH', 'pages/1');

    //     $this->assertRedirectedTo('pages/1');
    // }

    // public function testUpdateFails() {
    //     $this->mock->shouldReceive('find')->with(1)->andReturn(Mockery::mock(['update' => true]));
    //     $this->validate(false);
    //     $this->call('PATCH', 'pages/1');

    //     $this->assertRedirectedTo('pages/1/edit');
    //     $this->assertSessionHasErrors();
    //     $this->assertSessionHas('message');
    // }

    public function testDestroy() {
        $this->shouldReceive('findBySlug')->with($this->attributes['slug'])->andReturn(Mockery::mock(array('delete' => true)));

        $this->call('DELETE', 'pages/'.$this->attributes['slug']);

        $this->assertRedirectedToRoute('base');
    }
}
