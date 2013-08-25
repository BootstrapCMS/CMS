<?php namespace GrahamCampbell\BootstrapCMS\Tests\Controllers;

class PageControllerActionTest extends ResourcefulActionTestCase {

    use PageControllerSetupTrait;

    protected function destroyAssertions() {
        $this->assertRedirectedToRoute($this->getRoute('show'), $this->getRoutePram('home'));
    }
}
