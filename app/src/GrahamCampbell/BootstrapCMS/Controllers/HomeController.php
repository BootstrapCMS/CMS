<?php namespace GrahamCampbell\BootstrapCMS\Controllers;

/**
 * This file is part of Bootstrap CMS by Graham Campbell.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * @package    Bootstrap-CMS
 * @author     Graham Campbell
 * @license    GNU AFFERO GENERAL PUBLIC LICENSE
 * @copyright  Copyright (C) 2013  Graham Campbell
 * @link       https://github.com/GrahamCampbell/Bootstrap-CMS
 */

use Cache;
use Config;
use Log;
use Queuing;
use URL;

class HomeController extends BaseController {

    /**
     * Constructor (setup access permissions).
     *
     * @return void
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

    /**
     * Show the hello world page.
     *
     * @return \Illuminate\Http\Response
     */
    public function showWelcome() {
        Log::notice('Hello World');
        return $this->viewMake('hello');
    }

    /**
     * Show the test page.
     *
     * @return string
     */
    public function showTest() {
        Log::notice('Test 123');
        return 'Test 123';
    }

    /**
     * Send a test activation email.
     *
     * @return string
     */
    public function testQueue() {
        $data = array(
            'view'    => 'emails.welcome',
            'url'     => URL::route('pages.show', array('pages' => 'home')),
            'link'    => URL::route('account.activate', array('id' => 1, 'code' => 1234)),
            'email'   => Config::get('workbench.email'),
            'subject' => Config::get('cms.name').' - Welcome',
        );

        Queuing::push('GrahamCampbell\BootstrapCMS\Handlers\MailHandler', $data, Config::get('mail.queue'));
        return 'done';
    }

    /**
     * Queue a task that will fail.
     *
     * @return string
     */
    public function testError() {
        Queuing::push('GrahamCampbell\BootstrapCMS\Handlers\TestHandler', array());
        return 'done';
    }

    /**
     * Add a value to the cache.
     *
     * @return string
     */
    public function addValue($value) {
        Cache::put('cachetest', $value, 10);
        return 'done';
    }

    /**
     * Pull a value from the cache.
     *
     * @return string
     */
    public function getValue() {
        return Cache::get('cachetest');
    }
}
