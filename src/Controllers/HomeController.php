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

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Config;
use GrahamCampbell\Viewer\Classes\Viewer;
use GrahamCampbell\Queuing\Classes\Queuing;
use GrahamCampbell\Credentials\Classes\Credentials;

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
     * The viewer instance.
     *
     * @var \GrahamCampbell\Viewer\Classes\Viewer
     */
    protected $viewer;

    /**
     * The queuing instance.
     *
     * @var \GrahamCampbell\Queuing\Classes\Queuing
     */
    protected $queuing;

    /**
     * The email address.
     *
     * @var string
     */
    protected $email;

    /**
     * The email subject.
     *
     * @var string
     */
    protected $subject;

    /**
     * Create a new instance.
     *
     * @param  \GrahamCampbell\Credentials\Classes\Credentials  $credentials
     * @param  \GrahamCampbell\Viewer\Classes\Viewer  $viewer
     * @param  \GrahamCampbell\Queuing\Classes\Queuing  $queuing
     * @param  string  $email
     * @param  string  $subject
     * @return void
     */
    public function __construct(Credentials $credentials, Viewer $viewer, Queuing $queuing, $email, $subject)
    {
        $this->viewer = $viewer;
        $this->queuing = $queuing;
        $this->email = $email;
        $this->subject = $subject;

        $this->setPermissions(array(
            'testQueue' => 'admin',
            'testError' => 'admin',
            'addValue'  => 'mod',
            'getValue'  => 'user',
        ));

        parent::__construct($credentials);
    }

    /**
     * Show the hello world page.
     *
     * @return \Illuminate\Http\Response
     */
    public function showWelcome()
    {
        return $this->viewer->make('index');
    }

    /**
     * Show the test page.
     *
     * @return string
     */
    public function showTest()
    {
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
            'url'     => URL::to(Config::get('graham-campbell/core::home', 'pages/home')),
            'link'    => URL::route('account.activate', array('id' => 1, 'code' => 1234)),
            'email'   => $this->email,
            'subject' => $this->subject,
        );

        $this->queuing->pushMail($data);
        return 'done';
    }

    /**
     * Queue a task that will fail.
     *
     * @return string
     */
    public function testError()
    {
        $this->queuing->pushJob('test', array(), 'GrahamCampbell\BootstrapCMS\Handlers');
        return 'done';
    }

    /**
     * Return the viewer instance.
     *
     * @return \GrahamCampbell\Viewer\Classes\Viewer
     */
    public function getViewer()
    {
        return $this->viewer;
    }

    /**
     * Return the queuing instance.
     *
     * @return \GrahamCampbell\Queuing\Classes\Queuing
     */
    public function getQueuing()
    {
        return $this->queuing;
    }
}
