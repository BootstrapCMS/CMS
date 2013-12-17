<?php namespace GrahamCampbell\Tests\BootstrapCMS\Controllers;

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

trait CommentControllerSetupTrait {

    protected $model = 'GrahamCampbell\CMSCore\Models\Comment';
    protected $provider = 'GrahamCampbell\CMSCore\Facades\CommentProvider';
    protected $view = 'comment';
    protected $name = 'posts'; // yes, that's right - we should redirect to the posts routes
    protected $base = 'blog.posts'; // yes, that's right - we should redirect to the posts routes
    protected $uid = 'id';

    protected function extraLinks() {
        $this->addLinks(array(
            'getBody'      => 'body',
            'getUserId'    => 'user_id',
            'getPostId'    => 'post_id',
            'getVersion'   => 'version'
        ));
    }

    protected function extraMockingTests() {
        $this->assertEquals($this->mock->getBody(), $this->attributes['body']);
        $this->assertEquals($this->mock->getUserId(), $this->attributes['user_id']);
        $this->assertEquals($this->mock->getPostId(), $this->attributes['post_id']);
        $this->assertEquals($this->mock->getVersion(), $this->attributes['version']);
    }
}
