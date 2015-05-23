<?php

/*
 * This file is part of Bootstrap CMS.
 *
 * (c) Graham Campbell <graham@cachethq.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\BootstrapCMS\Presenters\RevisionDisplayers\Comment;

use GrahamCampbell\BootstrapCMS\Presenters\RevisionDisplayers\AbstractRevisionDisplayer;

/**
 * This is the abstract displayer class.
 *
 * @author Graham Campbell <graham@cachethq.io>
 */
abstract class AbstractDisplayer extends AbstractRevisionDisplayer
{
    /**
     * Get the post name.
     *
     * @return string
     */
    protected function name()
    {
        $comment = $this->wrappedObject->revisionable()->withTrashed()->first(['post_id']);

        $post = $comment->post()->withTrashed()->first(['title']);

        return ' "'.$post->title.'".';
    }
}
