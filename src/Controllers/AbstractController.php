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

use GrahamCampbell\Credentials\Controllers\AbstractController as Controller;
use GrahamCampbell\Credentials\Credentials;
use Illuminate\View\Factory;

/**
 * This is the abstract controller class.
 *
 * @package    Bootstrap-CMS
 * @author     Graham Campbell
 * @copyright  Copyright (C) 2013-2014  Graham Campbell
 * @license    https://github.com/GrahamCampbell/Bootstrap-CMS/blob/master/LICENSE.md
 * @link       https://github.com/GrahamCampbell/Bootstrap-CMS
 */
abstract class AbstractController extends Controller
{
    /**
     * A list of methods protected by edit permissions.
     *
     * @var array
     */
    protected $edits = array();

    /**
     * A list of methods protected by blog permissions.
     *
     * @var array
     */
    protected $blogs = array();

    /**
     * The view factory instance.
     *
     * @var \Illuminate\View\Factory
     */
    protected $view;

    /**
     * Create a new instance.
     *
     * @param  \GrahamCampbell\Credentials\Credentials  $credentials
     * @param  \Illuminate\View\Factory  $view
     * @return void
     */
    public function __construct(Credentials $credentials, Factory $view)
    {
        parent::__construct($credentials);

        $this->view = $view;

        $this->beforeFilter('credentials:edit', array('only' => $this->edits));
        $this->beforeFilter('credentials:blog', array('only' => $this->blogs));
    }
}
