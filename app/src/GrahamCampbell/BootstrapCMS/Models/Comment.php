<?php namespace GrahamCampbell\BootstrapCMS\Models;

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
 *
 * @package    Bootstrap-CMS
 * @author     Graham Campbell
 * @license    GNU AFFERO GENERAL PUBLIC LICENSE
 * @copyright  Copyright (C) 2013  Graham Campbell
 * @link       https://github.com/GrahamCampbell/Bootstrap-CMS
 */

use Event as LaravelEvent;

class Comment extends BaseModel implements Interfaces\IBodyModel, Relations\Interfaces\IBelongsToPost, Relations\Interfaces\IBelongsToUser {

    use Common\TraitBodyModel, Relations\Common\TraitBelongsToPost, Relations\Common\TraitBelongsToUser;

    /**
     * The table the comments are stored in.
     *
     * @var string
     */
    protected $table = 'comments';

    /**
     * The columns to select when displaying an index.
     *
     * @var array
     */
    public static $index = array('id', 'body', 'user_id', 'created_at');

    /**
     * The max comments per page when displaying a paginated index.
     *
     * @var int
     */
    public static $paginate = 20;

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
        'post_id' => 'required',
    );

    /**
     * The comment factory.
     *
     * @var array
     */
    public static $factory = array(
        'id'      => 1,
        'body'    => 'This a comment!',
        'user_id' => 1,
        'post_id' => 1,
    );

    /**
     * Create a new comment.
     *
     * @param  array  $input
     * @return \GrahamCampbell\BootstrapCMS\Models\Comment
     */
    public static function create(array $input) {
        $return = parent::create($input);
        LaravelEvent::fire('comment.created');
        return $return;
    }

    /**
     * Update an existing comment.
     *
     * @param  array  $input
     * @return \GrahamCampbell\BootstrapCMS\Models\Comment
     */
    public function update(array $input = array()) {
        $return = parent::update($input);
        LaravelEvent::fire('comment.updated');
        return $return;
    }

    /**
     * Delete an existing comment.
     *
     * @param  array  $input
     * @return void
     */
    public function delete() {
        $return = parent::delete();
        LaravelEvent::fire('comment.deleted');
        return $return;
    }
}
