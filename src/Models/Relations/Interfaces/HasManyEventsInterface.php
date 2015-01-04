<?php

/*
 * This file is part of Bootstrap CMS.
 *
 * (c) Graham Campbell <graham@mineuk.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\BootstrapCMS\Models\Relations\Interfaces;

/**
 * This is the has many events interface.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
interface HasManyEventsInterface
{
    /**
     * Get the event relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOneOrMany
     */
    public function events();

    /**
     * Delete all events.
     *
     * @return void
     */
    public function deleteEvents();
}
