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

use Venturecraft\Revisionable\RevisionableTrait;
use GrahamCampbell\Database\Models\AbstractModel;
use McCool\LaravelAutoPresenter\PresenterInterface;
use GrahamCampbell\BootstrapCMS\Models\Relations\Interfaces\BelongsToPostInterface;
use GrahamCampbell\BootstrapCMS\Models\Relations\Common\BelongsToPostTrait;
use GrahamCampbell\BootstrapCMS\Models\Relations\Interfaces\BelongsToUserInterface;
use GrahamCampbell\BootstrapCMS\Models\Relations\Common\BelongsToUserTrait;

/**
 * This is the comment model class.
 *
 * @package    Bootstrap-CMS
 * @author     Graham Campbell
 * @copyright  Copyright (C) 2013-2014  Graham Campbell
 * @license    https://github.com/GrahamCampbell/Bootstrap-CMS/blob/master/LICENSE.md
 * @link       https://github.com/GrahamCampbell/Bootstrap-CMS
 */
class Comment extends AbstractModel implements BelongsToPostInterface, BelongsToUserInterface, PresenterInterface
{
    use BelongsToPostTrait, BelongsToUserTrait, RevisionableTrait;

    /**
     * The table the comments are stored in.
     *
     * @var string
     */
    protected $table = 'comments';

    /**
     * The model name.
     *
     * @var string
     */
    public static $name = 'comment';

    /**
     * The columns to select when displaying an index.
     *
     * @var array
     */
    public static $index = array('id', 'body', 'user_id', 'created_at', 'version');

    /**
     * The columns to order by when displaying an index.
     *
     * @var string
     */
    public static $order = 'id';

    /**
     * The direction to order by when displaying an index.
     *
     * @var string
     */
    public static $sort = 'desc';

    /**
     * The comment validation rules.
     *
     * @var array
     */
    public static $rules = array(
        'body'    => 'required',
        'user_id' => 'required',
        'post_id' => 'required'
    );

    /**
     * Get the presenter class.
     *
     * @var string
     */
    public function getPresenter()
    {
        return 'GrahamCampbell\BootstrapCMS\Presenters\CommentPresenter';
    }
}
