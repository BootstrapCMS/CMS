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

use Carbon\Carbon;

trait EventControllerSetupTrait {

    protected $model = 'GrahamCampbell\CMSCore\Models\Event';
    protected $provider = 'GrahamCampbell\CMSCore\Facades\EventProvider';
    protected $view = 'event';
    protected $name = 'events';
    protected $base = 'events';
    protected $uid = 'id';

    protected function extraLinks() {
        $date = new Carbon($this->attributes['date']);
        $this->attributes['date'] = $date;
        $formatteddate = $date->format('l jS F Y \\- H:i:s');
        $this->attributes['formatteddate'] = $formatteddate;
        $this->addLinks(array(
            'getTitle'         => 'title',
            'getDate'          => 'date',
            'getFormattedDate' => 'formatteddate',
            'getLocation'      => 'location',
            'getBody'          => 'body',
            'getUserId'        => 'user_id',
        ));
    }

    protected function extraMockingTests() {
        $this->assertEquals($this->mock->getTitle(), $this->attributes['title']);
        $this->assertEquals($this->mock->getDate(), $this->attributes['date']);
        $this->assertEquals($this->mock->getLocation(), $this->attributes['location']);
        $this->assertEquals($this->mock->getBody(), $this->attributes['body']);
        $this->assertEquals($this->mock->getUserId(), $this->attributes['user_id']);
    }
}
