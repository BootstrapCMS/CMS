<?php namespace GrahamCampbell\BootstrapCMS\Tests\Controllers;

use Carbon;

trait EventControllerSetupTrait {

    protected $model = 'GrahamCampbell\BootstrapCMS\Models\Event';
    protected $provider = 'GrahamCampbell\BootstrapCMS\Facades\EventProvider';
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
