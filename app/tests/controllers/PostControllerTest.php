<?php

use Way\Tests\Factory;

class PostControllerTest extends ResourcefulTestCase {

    protected $model = 'Post';
    protected $name = 'posts';
    protected $base = 'blog.posts';
    protected $uid = 'id';

    public function setUpLinks() {
        parent::setUpLinks();

        $this->addLinks(array(
            'getTitle'     => 'title',
            'getSummary'   => 'summary',
            'getBody'      => 'body',
            'getUserId'    => 'user_id',
        ));
    }

    public function testMocking() {
        parent::testMocking();

        $this->assertEquals($this->mock->getTitle(), $this->attributes['title']);
        $this->assertEquals($this->mock->getSummary(), $this->attributes['summary']);
        $this->assertEquals($this->mock->getBody(), $this->attributes['body']);
        $this->assertEquals($this->mock->getUserId(), $this->attributes['user_id']);
    }

    public function testIndex() {
        $this->setAsPage();

        $this->mock->shouldReceive('orderBy')
            ->once()->andReturn(Mockery::mock(array('get' => array($this->mock))));

        $this->call('GET', $this->getPath());

        $this->assertResponseOk();
    }

    public function testShow() {
        $this->setAsPage();

        $this->mock->shouldReceive($this->getFind())
            ->with($this->getUid())->once()->andReturn($this->mock);

        $this->mock->shouldReceive('getUserName')
            ->once()->andReturn('name');

        $this->mock->shouldReceive('getCommentsReversed')
            ->once()->andReturn(array());

        $this->call('GET', $this->getPath($this->getUid()));

        $this->assertResponseOk();

        $this->assertViewHas(strtolower($this->model));
    }
}
