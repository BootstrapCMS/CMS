<?php

/*
 * This file is part of Bootstrap CMS.
 *
 * (c) Graham Campbell <graham@alt-three.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\BootstrapCMS\Presenters\RevisionDisplayers\Post;

use GrahamCampbell\BootstrapCMS\Presenters\RevisionDisplayers\AbstractRevisionDisplayer;

/**
 * This is the abstract displayer class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
abstract class AbstractDisplayer extends AbstractRevisionDisplayer
{
    /**
     * Get the change title.
     *
     * @return string
     */
    public function title()
    {
        return 'Updated Post';
    }

    /**
     * Get the post name.
     *
     * @return string
     */
    protected function name()
    {
        $post = $this->wrappedObject->revisionable()->withTrashed()->first(['title']);

        return ' "'.$post->title.'".';
    }
}
