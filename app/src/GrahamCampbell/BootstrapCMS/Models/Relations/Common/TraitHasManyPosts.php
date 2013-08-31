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

trait TraitHasManyPosts {

    /**
     * Get the post relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOneOrMany
     */
    public function posts() {
        return $this->hasMany('GrahamCampbell\BootstrapCMS\Models\Post');
    }

    /**
     * Get the post collection.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getPosts() {
        $model = 'GrahamCampbell\BootstrapCMS\Models\Post';

        if (property_exists($model, 'order')) {
            return $this->posts()->orderBy($model::$order, $model::$sort)->get($model::$index);
        }        
        return $this->posts()->get($model::$index);
    }

    /**
     * Get the specified post.
     *
     * @return \GrahamCampbell\BootstrapCMS\Models\Post
     */
    public function findPost($id, $columns = array('*')) {
        return $this->posts()->find($id, $columns);
    }

    /**
     * Delete all posts.
     *
     * @return void
     */
    public function deletePosts() {
        foreach($this->getPosts(array('id')) as $post) {
            $post->delete();
        }
    }
}
