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
 * This is the has many posts interface.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
interface HasManyPostsInterface
{
    /**
     * Get the post relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOneOrMany
     */
    public function posts();

    /**
     * Delete all posts.
     *
     * @return void
     */
    public function deletePosts();
}
