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

trait PageControllerSetupTrait {

    protected $model = 'GrahamCampbell\CMSCore\Models\Page';
    protected $provider = 'GrahamCampbell\CMSCore\Facades\PageProvider';
    protected $view = 'page';
    protected $name = 'pages';
    protected $base = 'pages';
    protected $uid = 'slug';

    protected function extraLinks() {
        $this->addLinks(array(
            'getTitle'     => 'title',
            'getSlug'      => 'slug',
            'getBody'      => 'body',
            'getCSS'       => '',
            'getJS'        => '',
            'getShowTitle' => 'show_title',
            'getShowNav'   => 'show_nav',
            'getIcon'      => 'icon',
            'getUserId'    => 'user_id',
        ));
    }

    protected function extraMockingTests() {
        $this->assertEquals($this->mock->getTitle(), $this->attributes['title']);
        $this->assertEquals($this->mock->getSlug(), $this->attributes['slug']);
        $this->assertEquals($this->mock->getBody(), $this->attributes['body']);
        $this->assertEquals($this->mock->getCSS(), $this->attributes['css']);
        $this->assertEquals($this->mock->getJS(), $this->attributes['js']);
        $this->assertEquals($this->mock->getShowTitle(), $this->attributes['show_title']);
        $this->assertEquals($this->mock->getShowNav(), $this->attributes['show_nav']);
        $this->assertEquals($this->mock->getIcon(), $this->attributes['icon']);
        $this->assertEquals($this->mock->getUserId(), $this->attributes['user_id']);
    }
}
