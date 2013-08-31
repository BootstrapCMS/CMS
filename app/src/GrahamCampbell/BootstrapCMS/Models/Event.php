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

class Event extends BaseModel implements Interfaces\ITitleModel, Interfaces\IBodyModel, Interfaces\IDateModel, Interfaces\ILocationModel, Relations\Interfaces\IBelongsToUser {

    use Common\TraitTitleModel, Common\TraitBodyModel, Common\TraitDateModel, Common\TraitLocationModel, Relations\Common\TraitBelongsToUser;

    /**
     * The table the events are stored in.
     *
     * @var string
     */
    protected $table = 'events';

    /**
     * The columns to select when displaying an index.
     *
     * @var array
     */
    public static $index = array('id', 'title', 'date');

    /**
     * The max events per page when displaying a paginated index.
     *
     * @var int
     */
    public static $paginate = 10;

    /**
     * The columns to order by when displaying an index.
     *
     * @var string
     */
    public static $order = 'date';

    /**
     * The direction to order by when displaying an index.
     *
     * @var string
     */
    public static $sort = 'asc';

    /**
     * The event validation rules.
     *
     * @var array
     */
    public static $rules = array(
        'title'    => 'required',
        'location' => 'required',
        'date'     => 'required',
        'body'     => 'required',
        'user_id'  => 'required',
    );

    /**
     * The event factory.
     *
     * @var array
     */
    public static $factory = array(
        'id'       => 1,
        'title'    => 'String',
        'location' => 'text',
        'date'     => '2013-08-01 12:34:56',
        'body'     => 'The body of a post.',
        'user_id'  => 1,
    );

    /**
     * Create a new event.
     *
     * @param  array  $input
     * @return \GrahamCampbell\BootstrapCMS\Models\Event
     */
    public static function create(array $input) {
        $return = parent::create($input);
        LaravelEvent::fire('event.created');
        return $return;
    }

    /**
     * Update an existing event.
     *
     * @param  array  $input
     * @return \GrahamCampbell\BootstrapCMS\Models\Event
     */
    public function update(array $input = array()) {
        $return = parent::update($input);
        LaravelEvent::fire('event.updated');
        return $return;
    }

    /**
     * Delete an existing event.
     *
     * @param  array  $input
     * @return void
     */
    public function delete() {
        $return = parent::delete();
        LaravelEvent::fire('event.deleted');
        return $return;
    }
}
