<?php

use Way\Tests\Factory;

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
        $this->shouldReceive('create')
            ->once()->andReturn($this->factory);

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

        $this->shouldReceive('findBySlug')
            ->with($this->attributes['slug'])->once()->andReturn($this->factory);

        $this->call('GET', 'pages/'.$this->attributes['slug']);

        $this->assertResponseOk();

        $this->assertViewHas('page');
    }

    public function testEdit() {
        $this->setAsPage();

        $this->shouldReceive('findBySlug')
            ->with($this->attributes['slug'])->once()->andReturn($this->factory);

        $this->call('GET', 'pages/'.$this->attributes['slug'].'/edit');

        $this->assertResponseOk();

        $this->assertViewHas('page');
    }

    public function testUpdate() {
        $this->validate(true);
        $this->shouldReceive('findBySlug')
            ->with($this->attributes['slug'])
            ->andReturn(Mockery::mock(array('update' => true, 'getSlug' => $this->attributes['slug'])));

        $this->call('PATCH', 'pages/'.$this->attributes['slug']);

        $this->assertRedirectedToRoute('pages.show', array('pages' => $this->attributes['slug']));
        $this->assertSessionHas('success');
    }

    public function testUpdateFails() {
        $this->validate(false);

        $this->call('PATCH', 'pages/'.$this->attributes['slug']);

        $this->assertRedirectedTo('pages/'.$this->attributes['slug'].'/edit');
        $this->assertSessionHasErrors();
    }

    public function testDestroy() {
        $this->shouldReceive('findBySlug')->with($this->attributes['slug'])->andReturn(Mockery::mock(array('delete' => true)));

        $this->call('DELETE', 'pages/'.$this->attributes['slug']);

        $this->assertRedirectedToRoute('base');
    }
}
