<?php namespace GrahamCampbell\BootstrapCMS\Models\Relations\Common;

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

trait TraitBelongsToPost {

    /**
     * Get the post relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post() {
        return $this->belongsTo('GrahamCampbell\BootstrapCMS\Models\Post');
    }

    /**
     * Get the post model.
     *
     * @return \GrahamCampbell\BootstrapCMS\Models\Post
     */
    public function getPost($columns = array('*')) {
        return $this->post()->first($columns);
    }

    /**
     * Get the post id.
     *
     * @return int
     */
    public function getPostId() {
        return $this->post_id;
    }
}
