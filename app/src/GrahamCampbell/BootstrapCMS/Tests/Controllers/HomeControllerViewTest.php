<?php namespace GrahamCampbell\BootstrapCMS\Tests\Controllers;

class HomeControllerViewTest extends ControllerTestCase {

    use HomeControllerSetupTrait;

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
