<?php

/*
 * This file is part of Bootstrap CMS.
 *
 * (c) Graham Campbell <graham@alt-three.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\BootstrapCMS\Presenters\RevisionDisplayers\Page;

/**
 * This is the show nav displayer class.
 *
 * @author Graham Campbell <graham@alt-three.com>
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
