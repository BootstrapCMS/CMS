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

namespace GrahamCampbell\BootstrapCMS\Observers;

use GrahamCampbell\CMSCore\Facades\PageProvider;

/**
 * This is the page subscriber class.
 *
 * @package    Bootstrap-CMS
 * @author     Graham Campbell
 * @copyright  Copyright (C) 2013-2014  Graham Campbell
 * @license    https://github.com/GrahamCampbell/Bootstrap-CMS/blob/master/LICENSE.md
 * @link       https://github.com/GrahamCampbell/Bootstrap-CMS
 */
class PageObserver
{
    /**
     * Handle a page creation.
     *
     * @return void
     */
    public function created($page = null)
    {
        PageProvider::refresh();
    }

    /**
     * Handle a page update.
     *
     * @param  \GrahamCampbell\CMSCore\Models\Page  $page
     * @return void
     */
    public function updated($page = null)
    {
        PageProvider::refresh();
    }

    /**
     * Handle a page deletion.
     *
     * @param  \GrahamCampbell\CMSCore\Models\Page  $page
     * @return void
     */
    public function deleted($page = null)
    {
        PageProvider::refresh();
    }

    /**
     * Handle a page save.
     *
     * @param  \GrahamCampbell\CMSCore\Models\Page  $page
     * @return void
     */
    public function saved($page = null)
    {
        PageProvider::refresh();
    }

    /**
     * Handle a page restore.
     *
     * @param  \GrahamCampbell\CMSCore\Models\Page  $page
     * @return void
     */
    public function restored($page = null)
    {
        PageProvider::refresh();
    }
}
