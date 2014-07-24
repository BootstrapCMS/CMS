<?php

/**
 * This file is part of Bootstrap CMS by Graham Campbell.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 */

namespace GrahamCampbell\BootstrapCMS\Models;

use GrahamCampbell\BootstrapCMS\Models\Relations\Common\HasManyCommentsTrait;
use GrahamCampbell\BootstrapCMS\Models\Relations\Common\HasManyEventsTrait;
use GrahamCampbell\BootstrapCMS\Models\Relations\Common\HasManyPagesTrait;
use GrahamCampbell\BootstrapCMS\Models\Relations\Common\HasManyPostsTrait;
use GrahamCampbell\BootstrapCMS\Models\Relations\Interfaces\HasManyCommentsInterface;
use GrahamCampbell\BootstrapCMS\Models\Relations\Interfaces\HasManyEventsInterface;
use GrahamCampbell\BootstrapCMS\Models\Relations\Interfaces\HasManyPagesInterface;
use GrahamCampbell\BootstrapCMS\Models\Relations\Interfaces\HasManyPostsInterface;
use GrahamCampbell\Credentials\Models\User as CredentialsUser;

/**
 * This is the user model class.
 *
 * @package    Bootstrap-CMS
 * @author     Graham Campbell
 * @copyright  Copyright (C) 2013-2014  Graham Campbell
 * @license    https://github.com/GrahamCampbell/Bootstrap-CMS/blob/master/LICENSE.md
 * @link       https://github.com/GrahamCampbell/Bootstrap-CMS
 */
class User extends CredentialsUser implements HasManyPagesInterface, HasManyPostsInterface, HasManyEventsInterface, HasManyCommentsInterface
{
    use HasManyPagesTrait, HasManyPostsTrait, HasManyEventsTrait, HasManyCommentsTrait;

    /**
     * Before deleting an existing model.
     *
     * @return mixed
     */
    public function beforeDelete()
    {
        $this->deletePages();
        $this->deletePosts();
        $this->deleteEvents();
        $this->deleteComments();
    }

    /**
     * Get the presenter class.
     *
     * @return string
     */
    public function getPresenter()
    {
        return 'GrahamCampbell\BootstrapCMS\Presenters\UserPresenter';
    }
}
