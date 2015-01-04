<?php

/*
 * This file is part of Bootstrap CMS.
 *
 * (c) Graham Campbell <graham@mineuk.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\BootstrapCMS\Observers;

use GrahamCampbell\BootstrapCMS\Facades\PageProvider;

/**
 * This is the page observer class.
 *
 * @author Graham Campbell <graham@mineuk.com>
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
        PageProvider::refresh();
    }

    /**
     * Handle a page update.
     *
     * @return void
     */
    public function updated()
    {
        PageProvider::refresh();
    }

    /**
     * Handle a page deletion.
     *
     * @return void
     */
    public function deleted()
    {
        PageProvider::refresh();
    }

    /**
     * Handle a page save.
     *
     * @return void
     */
    public function saved()
    {
        PageProvider::refresh();
    }

    /**
     * Handle a page restore.
     *
     * @return void
     */
    public function restored()
    {
        PageProvider::refresh();
    }
}
