<?php namespace GrahamCampbell\BootstrapCMS\Controllers;

use Log; // depreciated - use events

use Cache;
use Config;
use Queue;
use URL;

class HomeController extends BaseController {

    /**
     * Setup access permissions.
     */
    public function __construct() {
        $this->setPermissions(array(
            'testQueue' => 'admin',
            'testError' => 'admin',
            'addValue'  => 'mod',
            'getValue'  => 'user',
        ));

        parent::__construct();
    }

    public function showWelcome() {
        Log::notice('Hello World');
        return $this->viewMake('hello');
    }

    public function showTest() {
        Log::notice('Test 123');
        return 'Test 123';
    }

    public function testQueue() {
        $data = array(
            'view'    => 'emails.welcome',
            'url'     => URL::route('pages.show', array('pages' => 'home')),
            'link'    => URL::route('account.activate', array('id' => 1, 'code' => 1234)),
            'email'   => Config::get('workbench.email'),
            'subject' => Config::get('cms.name').' - Welcome',
        );

        Queue::push('GrahamCampbell\BootstrapCMS\Handlers\MailHandler', $data, Config::get('mail.queue'));
        return 'done';
    }

    public function testError() {
        Queue::push('GrahamCampbell\BootstrapCMS\Handlers\TestHandler', array());
        return 'done';
    }

    public function addValue($value) {
        Cache::put('cachetest', $value, 10);
    }

    public function getValue() {
        return Cache::get('cachetest');
    }
}
