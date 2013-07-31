<?php

class ExampleTest extends TestCase {

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample() {
        $this->call('GET', 'test');

        $this->assertResponseOk();
    }
}
