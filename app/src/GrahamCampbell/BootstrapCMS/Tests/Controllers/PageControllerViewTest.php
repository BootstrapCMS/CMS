<?php namespace GrahamCampbell\BootstrapCMS\Tests\Controllers;

class PageControllerViewTest extends ResourcefulViewTestCase {

    use PageControllerSetupTrait;

    protected function indexSetup() {
        // overwritten to cancel it
    }

    protected function indexMocking() {
        // overwritten to cancel it
    }

    protected function indexAssertions() {
        $this->assertRedirectedToRoute($this->getRoute('show'), $this->getRoutePram('home'));
    }
}
