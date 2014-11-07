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
use GrahamCampbell\BootstrapCMS\Models\Relations\Interfaces\HasManyCommentsInterface;
use GrahamCampbell\Credentials\Models\Relations\Common\BelongsToUserTrait;
use GrahamCampbell\Credentials\Models\Relations\Common\RevisionableTrait;
use GrahamCampbell\Credentials\Models\Relations\Interfaces\BelongsToUserInterface;
use GrahamCampbell\Credentials\Models\Relations\Interfaces\RevisionableInterface;
use GrahamCampbell\Database\Models\AbstractModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use McCool\LaravelAutoPresenter\HasPresenter;

/**
 * This is the post model class.
 *
 * @author    Graham Campbell <graham@mineuk.com>
 * @copyright 2013-2014 Graham Campbell
 * @license   <https://github.com/GrahamCampbell/Bootstrap-CMS/blob/master/LICENSE.md> AGPL 3.0
 */
class Post extends AbstractModel implements HasManyCommentsInterface, BelongsToUserInterface, RevisionableInterface, HasPresenter
{
    use HasManyCommentsTrait, BelongsToUserTrait, RevisionableTrait, SoftDeletes;

    /**
     * The table the posts are stored in.
     *
     * @var string
     */
    protected $table = 'posts';

    /**
     * The model name.
     *
     * @var string
     */
    public static $name = 'post';

    /**
     * The properties on the model that are dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The revisionable columns.
     *
     * @var array
     */
    protected $keepRevisionOf = ['title', 'summary', 'body'];

    /**
     * The columns to select when displaying an index.
     *
     * @var array
     */
    public static $index = ['id', 'title', 'summary'];

    /**
     * The max posts per page when displaying a paginated index.
     *
     * @var int
     */
    public static $paginate = 10;

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
     * The post validation rules.
     *
     * @var array
     */
    public static $rules = [
        'title'   => 'required',
        'summary' => 'required',
        'body'    => 'required',
        'user_id' => 'required',
    ];

    /**
     * Get the presenter class.
     *
     * @return string
     */
    public function getPresenterClass()
    {
        return 'GrahamCampbell\BootstrapCMS\Presenters\PostPresenter';
    }

    /**
     * Before deleting an existing model.
     *
     * @return void
     */
    public function beforeDelete()
    {
        $this->deleteComments();
    }
}
