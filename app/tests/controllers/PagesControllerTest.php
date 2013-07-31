<?php

use Way\Tests\Factory;

class PostsControllerTest extends TestCase {

    public function testIndex() {
        $this->call('GET', 'pages');

        $this->assertRedirectedToRoute('pages.show', array('pages' => 'home'));
    }

    public function testStoreFails() {
        Input::replace($input = Factory::attributesFor('Page', array('slug' => '')));

        $this->call('POST', 'pages');

        $this->assertRedirectedToRoute('pages.create');
        $this->assertSessionHasErrors();
    }
 
    public function testStoreSuccess() {
        Input::replace($input = Factory::attributesFor('Page'));
 
        Post::shouldReceive('create')->once();
 
        $this->call('POST', 'pages');
 
        $this->assertRedirectedToRoute('pages.index', ['flash']);
    } 
}
