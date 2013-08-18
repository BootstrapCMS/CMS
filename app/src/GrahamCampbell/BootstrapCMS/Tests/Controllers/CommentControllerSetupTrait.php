<?php namespace GrahamCampbell\BootstrapCMS\Tests\Controllers;

trait CommentControllerSetupTrait {

    protected $model = 'GrahamCampbell\BootstrapCMS\Models\Comment';
    protected $provider = 'GrahamCampbell\BootstrapCMS\Facades\CommentProvider';
    protected $view = 'comment';
    protected $name = 'posts'; // yes, that's right - we should redirect to the posts routes
    protected $base = 'blog.posts'; // yes, that's right - we should redirect to the posts routes
    protected $uid = 'id';

    protected function extraLinks() {
        $this->addLinks(array(
            'getBody'      => 'body',
            'getUserId'    => 'user_id',
            'getPostId'    => 'post_id',
        ));
    }

    protected function extraMockingTests() {
        $this->assertEquals($this->mock->getBody(), $this->attributes['body']);
        $this->assertEquals($this->mock->getUserId(), $this->attributes['user_id']);
        $this->assertEquals($this->mock->getPostId(), $this->attributes['post_id']);
    }
}
