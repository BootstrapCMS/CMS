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
 * This is the has many posts trait.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
trait HasManyPostsTrait
{
    /**
     * Get the post relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOneOrMany
     */
    public function posts()
    {
        return $this->hasMany('GrahamCampbell\BootstrapCMS\Models\Post');
    }

    /**
     * Delete all posts.
     *
     * @return void
     */
    public function deletePosts()
    {
        foreach ($this->posts()->get(['id']) as $post) {
            $post->delete();
        }
    }
}
