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

use Illuminate\Support\Facades\View;

/**
 * This is the caching controller class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class CachingController extends AbstractController
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->setPermissions([
            'getIndex' => 'admin',
        ]);

        parent::__construct();
    }

    /**
     * Display the index page.
     *
     * @return \Illuminate\View\View
     */
    public function getIndex()
    {
        return View::make('caching.index');
    }
}
