<?php

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
 */

namespace GrahamCampbell\BootstrapCMS\Controllers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use GrahamCampbell\Viewer\Facades\Viewer;
use GrahamCampbell\Queuing\Facades\Queuing;
use GrahamCampbell\CMSCore\Controllers\AbstractController;

/**
 * This is the home controller class.
 *
 * @package    Bootstrap-CMS
 * @author     Graham Campbell
 * @copyright  Copyright (C) 2013-2014  Graham Campbell
 * @license    https://github.com/GrahamCampbell/Bootstrap-CMS/blob/master/LICENSE.md
 * @link       https://github.com/GrahamCampbell/Bootstrap-CMS
 */
class HomeController extends AbstractController
{
    /**
     * Constructor (setup access permissions).
     *
     * @return void
     */
    public function __construct()
    {
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
    public function showWelcome()
    {
        Log::notice('Hello World');
        return Viewer::make('index');
    }

    /**
     * Show the test page.
     *
     * @return string
     */
    public function showTest()
    {
        Log::notice('Test 123');
        return 'Test 123';
    }

    /**
     * Send a test activation email.
     *
     * @return string
     */
    public function testQueue()
    {
        $data = array(
            'view'    => 'emails.welcome',
            'url'     => URL::route('pages.show', array('pages' => 'home')),
            'link'    => URL::route('account.activate', array('id' => 1, 'code' => 1234)),
            'email'   => Config::get('workbench.email'),
            'subject' => Config::get('platform.name').' - Welcome',
        );

        Queuing::pushMail($data);
        return 'done';
    }

    /**
     * Queue a task that will fail.
     *
     * @return string
     */
    public function testError()
    {
        Queuing::pushJob('test', array(), 'GrahamCampbell\BootstrapCMS\Handlers');
        return 'done';
    }
}
