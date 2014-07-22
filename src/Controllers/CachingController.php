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

use GrahamCampbell\Credentials\Credentials;
use Illuminate\View\Factory;

/**
 * This is the caching controller class.
 *
 * @package    Bootstrap-CMS
 * @author     Graham Campbell
 * @copyright  Copyright (C) 2013-2014  Graham Campbell
 * @license    https://github.com/GrahamCampbell/Bootstrap-CMS/blob/master/LICENSE.md
 * @link       https://github.com/GrahamCampbell/Bootstrap-CMS
 */
class CachingController extends AbstractController
{
    /**
     * Create a new instance.
     *
     * @param  \GrahamCampbell\Credentials\Credentials  $credentials
     * @param  \Illuminate\View\Factory  $view
     * @return void
     */
    public function __construct(Credentials $credentials, Factory $view)
    {
        $this->setPermissions(array(
            'getIndex' => 'admin',
        ));

        parent::__construct($credentials, $view);
    }

    /**
     * Display the index page.
     *
     * @return \Illuminate\View\View
     */
    public function getIndex()
    {
        return $this->view->make('caching.index');
    }
}
