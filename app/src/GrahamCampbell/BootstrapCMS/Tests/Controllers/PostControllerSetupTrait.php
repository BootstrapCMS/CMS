<?php namespace GrahamCampbell\BootstrapCMS\Tests\Controllers;

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

trait PostControllerSetupTrait {

    protected $model = 'GrahamCampbell\CMSCore\Models\Post';
    protected $provider = 'GrahamCampbell\BootstrapCMS\Facades\PostProvider';
    protected $view = 'post';
    protected $name = 'posts';
    protected $base = 'blog.posts';
    protected $uid = 'id';

    protected function extraLinks() {
        $this->addLinks(array(
            'getTitle'     => 'title',
            'getSummary'   => 'summary',
            'getBody'      => 'body',
            'getUserId'    => 'user_id',
        ));
    }

    protected function extraMockingTests() {
        $this->assertEquals($this->mock->getTitle(), $this->attributes['title']);
        $this->assertEquals($this->mock->getSummary(), $this->attributes['summary']);
        $this->assertEquals($this->mock->getBody(), $this->attributes['body']);
        $this->assertEquals($this->mock->getUserId(), $this->attributes['user_id']);
    }
}
