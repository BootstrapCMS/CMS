<?php

/*
 * This file is part of Bootstrap CMS.
 *
 * (c) Graham Campbell <graham@mineuk.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\BootstrapCMS\Presenters;

use GrahamCampbell\BootstrapCMS\Models\Comment;
use GrahamCampbell\Credentials\Presenters\AuthorPresenterTrait;
use McCool\LaravelAutoPresenter\BasePresenter;

/**
 * This is the comment presenter class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
class CommentPresenter extends BasePresenter
{
    use AuthorPresenterTrait;

    /**
     * Create a new instance.
     *
     * @param \GrahamCampbell\BootstrapCMS\Models\Comment $comment
     *
     * @return void
     */
    public function __construct(Comment $comment)
    {
        $this->resource = $comment;
    }
}
