<?php namespace GrahamCampbell\BootstrapCMS\Tests;

class BasicTest extends TestCase {

    public function testBase() {
        $this->call('GET', '/');

        $this->assertRedirectedToRoute('pages.show', array('pages' => 'home'));
    }

    public function testBlog() {
        $this->call('GET', 'blog');

        $this->assertRedirectedToRoute('blog.posts.index');
    }
}
