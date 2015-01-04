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
 * This is the has many comments interface.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
interface HasManyCommentsInterface
{
    /**
     * Get the comment relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOneOrMany
     */
    public function comments();

    /**
     * Delete all comments.
     *
     * @return void
     */
    public function deleteComments();
}
