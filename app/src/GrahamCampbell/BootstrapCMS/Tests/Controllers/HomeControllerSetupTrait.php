<?php namespace GrahamCampbell\BootstrapCMS\Tests\Controllers;

trait HomeControllerSetupTrait {

    // ControllerTestCase requires for the controller to be attached to a model
    // we will mock the page model because we have to anyway for the nav bar
    // we will set the base url as an empty string so we can request any page

    protected $model = 'GrahamCampbell\BootstrapCMS\Models\Page';
    protected $provider = 'GrahamCampbell\BootstrapCMS\Facades\PageProvider';
    protected $view = 'page';
    protected $name = 'pages';
    protected $base = '';
    protected $uid = 'slug';

}
