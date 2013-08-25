<?php namespace GrahamCampbell\BootstrapCMS\Tests\Controllers;

class CommentControllerActionTest extends ResourcefulActionTestCase {

    use CommentControllerSetupTrait;

    protected function storeCall() {
        $this->call('POST', $this->getPath($this->getUid().'/comments'));
    }

    protected function storeFailsAssertions() {
        $this->assertRedirectedToRoute($this->getRoute('show'), $this->getRoutePram($this->getUid()));
        $this->assertSessionHas('error');
    }

    protected function updateCall() {
        $this->call('PATCH', $this->getPath($this->getUid().'/comments/'.$this->getUid()));
    }

    protected function updateFailsAssertions() {
        $this->assertRedirectedToRoute($this->getRoute('show'), $this->getRoutePram($this->getUid()));
        $this->assertSessionHas('error');
    }

    protected function destroyCall() {
        $this->call('DELETE', $this->getPath($this->getUid().'/comments/'.$this->getUid()));
    }

    protected function destroyAssertions() {
        $this->assertRedirectedToRoute($this->getRoute('show'), $this->getRoutePram($this->getUid()));
        $this->assertSessionHas('success');
    }
}
