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

namespace GrahamCampbell\BootstrapCMS\Http\Controllers;

use GrahamCampbell\BootstrapCMS\Http\Middleware\Auth\Blog;
use GrahamCampbell\BootstrapCMS\Http\Middleware\Auth\Edit;
use GrahamCampbell\Credentials\Http\Controllers\AbstractController as Controller;

/**
 * This is the abstract controller class.
 *
 * @author    Graham Campbell <graham@mineuk.com>
 * @copyright 2013-2014 Graham Campbell
 * @license   <https://github.com/GrahamCampbell/Bootstrap-CMS/blob/master/LICENSE.md> AGPL 3.0
 */
abstract class AbstractController extends Controller
{
    /**
     * A list of methods protected by edit permissions.
     *
     * @var string[]
     */
    protected $edits = [];

    /**
     * A list of methods protected by blog permissions.
     *
     * @var string[]
     */
    protected $blogs = [];

    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        if ($this->edits) {
            $this->middleware(Edit::class, ['only' => $this->edits]);
        }

        if ($this->blogs) {
            $this->middleware(Blog::class, ['only' => $this->blogs]);
        }
    }
}
