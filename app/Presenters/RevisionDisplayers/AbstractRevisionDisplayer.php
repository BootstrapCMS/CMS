<?php

/*
 * This file is part of Bootstrap CMS.
 *
 * (c) Graham Campbell <graham@alt-three.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\BootstrapCMS\Presenters\RevisionDisplayers;

use GrahamCampbell\Credentials\Presenters\RevisionDisplayers\AbstractRevisionDisplayer as BaseRevisionDisplayer;
use GrahamCampbell\Credentials\Presenters\RevisionDisplayers\RevisionDisplayerInterface;

/**
 * This is the abstract displayer class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
abstract class AbstractRevisionDisplayer extends BaseRevisionDisplayer implements RevisionDisplayerInterface
{
    /**
     * Get the change description.
     *
     * @return string
     */
    public function description()
    {
        if ($this->presenter->wasByCurrentUser()) {
            return $this->current();
        }

        return $this->external();
    }

    /**
     * Get the change description from the context of
     * the change being made by the current user.
     *
     * @return string
     */
    abstract protected function current();

    /**
     * Get the change description from the context of
     * the change not being made by the current user.
     *
     * @return string
     */
    abstract protected function external();
}
