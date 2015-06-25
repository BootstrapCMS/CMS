<?php

/*
 * This file is part of Bootstrap CMS.
 *
 * (c) Graham Campbell <graham@alt-three.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\BootstrapCMS\Models;

use GrahamCampbell\BootstrapCMS\Models\Relations\HasManyCommentsTrait;
use GrahamCampbell\BootstrapCMS\Models\Relations\HasManyEventsTrait;
use GrahamCampbell\BootstrapCMS\Models\Relations\HasManyPagesTrait;
use GrahamCampbell\BootstrapCMS\Models\Relations\HasManyPostsTrait;
use GrahamCampbell\Credentials\Models\User as CredentialsUser;

/**
 * This is the user model class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class User extends CredentialsUser
{
    use HasManyPagesTrait, HasManyPostsTrait, HasManyEventsTrait, HasManyCommentsTrait;

    /**
     * Get the presenter class.
     *
     * @return string
     */
    public function getPresenterClass()
    {
        return 'GrahamCampbell\BootstrapCMS\Presenters\UserPresenter';
    }

    /**
     * Before deleting an existing model.
     *
     * @return void
     */
    public function beforeDelete()
    {
        $this->deletePages();
        $this->deletePosts();
        $this->deleteEvents();
        $this->deleteComments();
    }
}
