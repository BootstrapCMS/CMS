<?php

class CommentControllerTest extends ResourcefulTestCase {

    // note that the comments controller has no views associated with it
    // index, create, show, and edit tests will not be performed

    protected $model = 'Comment';
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

    public function testIndex() {
        // overwritten to cancel it
    }

    public function testCreate() {
        // overwritten to cancel it
    }

    protected function storeCall() {
        $this->call('POST', 'blog/posts/1/comments');
    }

    protected function storeFailsAssertions() {
        $this->assertRedirectedToRoute($this->getRoute('show'), $this->getRoutePram($this->getUid()));
        $this->assertSessionHas('error');
    }

    public function testShow() {
        // overwritten to cancel it
    }

    public function testEdit() {
        // overwritten to cancel it
    }

    protected function updateCall() {
        $this->call('PATCH', 'blog/posts/1/comments/1');
    }

    protected function updateFailsAssertions() {
        $this->assertRedirectedToRoute($this->getRoute('show'), $this->getRoutePram($this->getUid()));
        $this->assertSessionHas('error');
    }

    protected function destroyCall() {
        $this->call('DELETE', 'blog/posts/1/comments/1');
    }

    protected function destroyAssertions() {
        $this->assertRedirectedToRoute($this->getRoute('show'), $this->getRoutePram($this->getUid()));
        $this->assertSessionHas('success');
    }
}
