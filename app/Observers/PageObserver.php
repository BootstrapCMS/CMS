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

use GrahamCampbell\BootstrapCMS\Facades\PageRepository;

/**
 * This is the page observer class.
 *
 * @author    Graham Campbell <graham@mineuk.com>
 * @copyright 2013-2014 Graham Campbell
 * @license   <https://github.com/GrahamCampbell/Bootstrap-CMS/blob/master/LICENSE.md> AGPL 3.0
 */
class PageObserver
{
    /**
     * Handle a page creation.
     *
     * @return void
     */
    public function created()
    {
        PageRepository::refresh();
    }

    /**
     * Handle a page update.
     *
     * @return void
     */
    public function updated()
    {
        PageRepository::refresh();
    }

    /**
     * Handle a page deletion.
     *
     * @return void
     */
    public function deleted()
    {
        PageRepository::refresh();
    }

    /**
     * Handle a page save.
     *
     * @return void
     */
    public function saved()
    {
        PageRepository::refresh();
    }

    /**
     * Handle a page restore.
     *
     * @return void
     */
    public function restored()
    {
        PageRepository::refresh();
    }
}
