<?php

use Way\Tests\Factory;

class PagesControllerTest extends ControllerTestCase {

    protected $model = 'Page';

    public function setup() {
        parent::setup();

        $this->addLinks(array(
            'getTitle'     => 'title',
            'getSlug'      => 'slug',
            'getBody'      => 'body',
            'getShowTitle' => 'show_title',
            'getShowNav'   => 'show_nav',
            'getIcon'      => 'icon',
            'getUserId'    => 'user_id',
        ));
    }

    public function testMocking() {
        parent::testMocking();

        $this->assertEquals($this->mock->getTitle(), $this->attributes['title']);
        $this->assertEquals($this->mock->getSlug(), $this->attributes['slug']);
        $this->assertEquals($this->mock->getBody(), $this->attributes['body']);
        $this->assertEquals($this->mock->getShowTitle(), $this->attributes['show_title']);
        $this->assertEquals($this->mock->getShowNav(), $this->attributes['show_nav']);
        $this->assertEquals($this->mock->getIcon(), $this->attributes['icon']);
        $this->assertEquals($this->mock->getUserId(), $this->attributes['user_id']);
    }

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
            ->once()->andReturn($this->mock);
        

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
            ->with($this->attributes['slug'])->once()->andReturn($this->mock);

        $this->call('GET', 'pages/'.$this->attributes['slug']);

        $this->assertResponseOk();

        $this->assertViewHas('page');
    }

    public function testEdit() {
        $this->setAsPage();

        $this->shouldReceive('findBySlug')
            ->with($this->attributes['slug'])->once()->andReturn($this->mock);

        $this->call('GET', 'pages/'.$this->attributes['slug'].'/edit');

        $this->assertResponseOk();

        $this->assertViewHas('page');
    }

    public function testUpdate() {
        $this->validate(true);
        $this->shouldReceive('update');
        $this->shouldReceive('findBySlug')
            ->with($this->attributes['slug'])->andReturn($this->mock);

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
        $this->shouldReceive('findBySlug')
            ->with($this->attributes['slug'])->andReturn(Mockery::mock(array('delete' => true)));

        $this->call('DELETE', 'pages/'.$this->attributes['slug']);

        $this->assertRedirectedToRoute('base');
    }
}
