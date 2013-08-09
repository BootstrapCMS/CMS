<?php

class PageControllerViewTest extends ResourcefulViewTestCase {

    use PageControllerSetupTrait;

    protected function indexSetup() {
        // overwritten to cancel it
    }

    protected function indexAssertions() {
        $this->assertRedirectedToRoute($this->getRoute('show'), $this->getRoutePram('home'));
    }

}
