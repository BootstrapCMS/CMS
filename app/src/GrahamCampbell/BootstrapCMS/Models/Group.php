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

use Cartalyst\Sentry\Groups\Eloquent\Group as SentryGroup;

class Group extends SentryGroup implements Interfaces\IBaseModel {

    use Common\TraitBaseModel;

    /**
     * The table the groups are stored in.
     *
     * @var string
     */
    protected $table = 'groups';

    /**
     * The columns to select when displaying an index.
     *
     * @var array
     */
    public static $index = array('id', 'name');

    /**
     * The max groups per page when displaying a paginated index.
     *
     * @var int
     */
    public static $paginate = 20;

    /**
     * The columns to order by when displaying an index.
     *
     * @var string
     */
    public static $order = 'name';

    /**
     * The direction to order by when displaying an index.
     *
     * @var string
     */
    public static $sort = 'asc';

    /**
     * Create a new group.
     *
     * @param  array  $input
     * @return \GrahamCampbell\BootstrapCMS\Models\Group
     */
    public static function create(array $input) {
        $return = parent::create($input);
        LaravelEvent::fire('group.created');
        return $return;
    }

    /**
     * Update an existing group.
     *
     * @param  array  $input
     * @return \GrahamCampbell\BootstrapCMS\Models\Group
     */
    public function update(array $input = array()) {
        $return = parent::update($input);
        LaravelEvent::fire('group.updated');
        return $return;
    }

    /**
     * Delete an existing group.
     *
     * @param  array  $input
     * @return void
     */
    public function delete() {
        $return = parent::delete();
        LaravelEvent::fire('group.deleted');
        return $return;
    }
}
