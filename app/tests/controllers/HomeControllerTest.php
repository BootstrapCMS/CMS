<?php

class HomeControllerTest extends ControllerTestCase {

    // ControllerTestCase requires for the controller to be attached to a model
    // we will mock the page model because we have to anyway for the nav bar
    // we will set the base url as an empty string so we can request any page

    protected $model = 'Page';
    protected $name = 'pages';
    protected $base = '';
    protected $uid = 'slug';

    public function testShowWelcome() {
        $this->setAsPage();

        $this->call('GET', $this->getPath('hello'));

        $this->assertResponseOk();
    }

    public function testShowTest() {
        $this->call('GET', $this->getPath('test'));

        $this->assertResponseOk();
    }
}
