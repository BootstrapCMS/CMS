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

class Post extends BaseModel implements Interfaces\ITitleModel, Interfaces\IBodyModel, Relations\Interfaces\IHasManyComments, Relations\Interfaces\IBelongsToUser {

    use Common\TraitTitleModel, Common\TraitBodyModel, Relations\Common\TraitHasManyComments, Relations\Common\TraitBelongsToUser;

    /**
     * The table the posts are stored in.
     *
     * @var string
     */
    protected $table = 'posts';

    /**
     * The columns to select when displaying an index.
     *
     * @var array
     */
    public static $index = array('id', 'title', 'summary');

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
    public static $rules = array(
        'title'   => 'required',
        'summary' => 'required',
        'body'    => 'required',
        'user_id' => 'required',
    );

    /**
     * The post factory.
     *
     * @var array
     */
    public static $factory = array(
        'id'      => 1,
        'title'   => 'String',
        'summary' => 'Summary of a post.',
        'body'    => 'The body of a post.',
        'user_id' => 1,
    );

    /**
     * Get summary.
     *
     * @return string
     */
    public function getSummary() {
        return $this->summary;
    }

    /**
     * Create a new post.
     *
     * @param  array  $input
     * @return \GrahamCampbell\BootstrapCMS\Models\Post
     */
    public static function create(array $input) {
        $return = parent::create($input);
        LaravelEvent::fire('post.created');
        return $return;
    }

    /**
     * Update an existing post.
     *
     * @param  array  $input
     * @return \GrahamCampbell\BootstrapCMS\Models\Post
     */
    public function update(array $input = array()) {
        $return = parent::update($input);
        LaravelEvent::fire('post.updated');
        return $return;
    }

    /**
     * Delete an existing post.
     *
     * @param  array  $input
     * @return void
     */
    public function delete() {
        $this->deleteComments();
        $return = parent::delete();
        LaravelEvent::fire('post.deleted');
        return $return;
    }
}
