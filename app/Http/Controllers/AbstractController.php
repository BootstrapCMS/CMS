<?php

/*
 * This file is part of Bootstrap CMS.
 *
 * (c) Graham Campbell <graham@alt-three.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\BootstrapCMS\Http\Controllers;

use GrahamCampbell\BootstrapCMS\Http\Middleware\Auth\Blog;
use GrahamCampbell\BootstrapCMS\Http\Middleware\Auth\Edit;
use GrahamCampbell\Credentials\Http\Controllers\AbstractController as Controller;

/**
 * This is the abstract controller class.
 *
 * @author Graham Campbell <graham@alt-three.com>
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
