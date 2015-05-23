<?php

/*
 * This file is part of Bootstrap CMS.
 *
 * (c) Graham Campbell <graham@cachethq.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\BootstrapCMS\Presenters;

use GrahamCampbell\Credentials\Presenters\AuthorPresenterTrait;
use McCool\LaravelAutoPresenter\BasePresenter;

/**
 * This is the comment presenter class.
 *
 * @author Graham Campbell <graham@cachethq.io>
 */
class CommentPresenter extends BasePresenter
{
    use AuthorPresenterTrait;
}
