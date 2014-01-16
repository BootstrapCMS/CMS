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

namespace GrahamCampbell\Tests\BootstrapCMS\Controllers;

/**
 * This is the home controller setup trait.
 *
 * @package    Bootstrap-CMS
 * @author     Graham Campbell
 * @copyright  Copyright (C) 2013-2014  Graham Campbell
 * @license    https://github.com/GrahamCampbell/Bootstrap-CMS/blob/master/LICENSE.md
 * @link       https://github.com/GrahamCampbell/Bootstrap-CMS
 */
trait HomeControllerSetupTrait
{
    // ControllerTestCase requires for the controller to be attached to a model
    // we will mock the page model because we have to anyway for the nav bar
    // we will set the base url as an empty string so we can request any page

    protected $model = 'GrahamCampbell\CMSCore\Models\Page';
    protected $provider = 'GrahamCampbell\CMSCore\Facades\PageProvider';
    protected $view = 'page';
    protected $name = 'pages';
    protected $base = '';
    protected $uid = 'slug';
}
