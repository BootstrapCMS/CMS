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
 * This is the has many comments trait.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
trait HasManyCommentsTrait
{
    /**
     * Get the comment relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOneOrMany
     */
    public function comments()
    {
        return $this->hasMany('GrahamCampbell\BootstrapCMS\Models\Comment');
    }

    /**
     * Delete all comments.
     *
     * @return void
     */
    public function deleteComments()
    {
        foreach ($this->comments()->get(['id']) as $comment) {
            $comment->delete();
        }
    }
}
