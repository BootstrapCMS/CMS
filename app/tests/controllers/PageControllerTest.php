<?php

class PageControllerTest extends ResourcefulTestCase {

    protected $model = 'Page';
    protected $name = 'pages';
    protected $base = 'pages';
    protected $uid = 'slug';

    public function setUpLinks() {
        parent::setUpLinks();

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
        $this->call('GET', $this->getPath());

        $this->assertRedirectedToRoute($this->getRoute('show'), $this->getRoutePram('home'));
    }
}
