<?php

class BasicTest extends TestCase {

    public function testBase() {
        $this->call('GET', '/');

        $this->assertRedirectedToRoute('pages.show', array('pages' => 'home'));
    }

    public function testTest() {
        $this->call('GET', 'test');

        $this->assertResponseOk();
    }
}
