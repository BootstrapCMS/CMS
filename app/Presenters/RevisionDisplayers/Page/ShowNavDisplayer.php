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

namespace GrahamCampbell\BootstrapCMS\Presenters\RevisionDisplayers\Page;

/**
 * This is the show nav displayer class.
 *
 * @author    Graham Campbell <graham@mineuk.com>
 * @copyright 2013-2014 Graham Campbell
 * @license   <https://github.com/GrahamCampbell/Bootstrap-CMS/blob/master/LICENSE.md> AGPL 3.0
 */
class ShowNavDisplayer extends AbstractDisplayer
{
    /**
     * Get the change description from the context of
     * the change being made by the current user.
     *
     * @return string
     */
    protected function current()
    {
        if ($this->wrappedObject->new_value) {
            return 'You added '.$this->name(false).'to the nav bar.';
        }

        return 'You removed '.$this->name(false).'from the nav bar.';
    }

    /**
     * Get the change description from the context of
     * the change not being made by the current user.
     *
     * @return string
     */
    protected function external()
    {
        if ($this->wrappedObject->new_value) {
            return 'This user added '.$this->name(false).'to the nav bar.';
        }

        return 'This user removed '.$this->name(false).'from the nav bar.';
    }
}
