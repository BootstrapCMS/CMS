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

use GrahamCampbell\Viewer\Facades\Viewer;
use GrahamCampbell\CMSCore\Controllers\AbstractController;

/**
 * This is the queuing controller class.
 *
 * @package    Bootstrap-CMS
 * @author     Graham Campbell
 * @copyright  Copyright (C) 2013  Graham Campbell
 * @license    https://github.com/GrahamCampbell/Bootstrap-CMS/blob/develop/LICENSE.md
 * @link       https://github.com/GrahamCampbell/Bootstrap-CMS
 */
class QueuingController extends AbstractController
{
    /**
     * Constructor (setup access permissions).
     *
     * @return void
     */
    public function __construct()
    {
        $this->setPermissions(array(
            'getIndex' => 'admin',
        ));

        parent::__construct();
    }

    /**
     * Display the index page.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        return Viewer::make('queuing.index', array(), 'admin');
    }
}
