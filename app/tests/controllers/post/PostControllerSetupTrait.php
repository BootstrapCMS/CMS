<?php

trait PostControllerSetupTrait {

    protected $model = 'Post';
    protected $name = 'posts';
    protected $base = 'blog.posts';
    protected $uid = 'id';

    protected function extraLinks() {
        $this->addLinks(array(
            'getTitle'     => 'title',
            'getSummary'   => 'summary',
            'getBody'      => 'body',
            'getUserId'    => 'user_id',
        ));
    }

    protected function extraMockingTests() {
        $this->assertEquals($this->mock->getTitle(), $this->attributes['title']);
        $this->assertEquals($this->mock->getSummary(), $this->attributes['summary']);
        $this->assertEquals($this->mock->getBody(), $this->attributes['body']);
        $this->assertEquals($this->mock->getUserId(), $this->attributes['user_id']);
    }
}
