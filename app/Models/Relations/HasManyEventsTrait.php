<?php

/*
 * This file is part of Bootstrap CMS.
 *
 * (c) Graham Campbell <graham@alt-three.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\BootstrapCMS\Models\Relations;

/**
 * This is the has many events trait.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
trait HasManyEventsTrait
{
    /**
     * Get the event relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOneOrMany
     */
    public function events()
    {
        return $this->hasMany('GrahamCampbell\BootstrapCMS\Models\Event');
    }

    /**
     * Delete all events.
     *
     * @return void
     */
    public function deleteEvents()
    {
        foreach ($this->events()->get(['id']) as $event) {
            $event->delete();
        }
    }
}
