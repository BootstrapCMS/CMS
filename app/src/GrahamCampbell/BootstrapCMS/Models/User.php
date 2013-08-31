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

use Cartalyst\Sentry\Users\Eloquent\User as SentryUser;

class User extends SentryUser implements Interfaces\IBaseModel, Interfaces\INameModel, Relations\Interfaces\IHasManyPages, Relations\Interfaces\IHasManyPosts, Relations\Interfaces\IHasManyEvents, Relations\Interfaces\IHasManyComments {

    use Common\TraitBaseModel, Common\TraitNameModel, Relations\Common\TraitHasManyPages, Relations\Common\TraitHasManyPosts, Relations\Common\TraitHasManyEvents, Relations\Common\TraitHasManyComments;

    /**
     * The table the users are stored in.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The columns to select when displaying an index.
     *
     * @var array
     */
    public static $index = array('id', 'email', 'first_name', 'last_name');

    /**
     * The max users per page when displaying a paginated index.
     *
     * @var int
     */
    public static $paginate = 20;

    /**
     * The columns to order by when displaying an index.
     *
     * @var string
     */
    public static $order = 'email';

    /**
     * The direction to order by when displaying an index.
     *
     * @var string
     */
    public static $sort = 'asc';

    /**
     * Get email.
     *
     * @param  array  $input
     * @return void
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Create a new user.
     *
     * @param  array  $input
     * @return \GrahamCampbell\BootstrapCMS\Models\User
     */
    public static function create(array $input) {
        $return = parent::create($input);
        LaravelEvent::fire('user.created');
        return $return;
    }

    /**
     * Update an existing user.
     *
     * @param  array  $input
     * @return \GrahamCampbell\BootstrapCMS\Models\User
     */
    public function update(array $input = array()) {
        $return = parent::update($input);
        LaravelEvent::fire('user.updated');
        return $return;
    }

    /**
     * Delete an existing user.
     *
     * @param  array  $input
     * @return void
     */
    public function delete() {
        $this->deletePages();
        $this->deletePosts();
        $this->deleteEvents();
        $this->deleteComments();
        $return = parent::delete();
        LaravelEvent::fire('user.deleted');
        return $return;
    }
}
