<?php

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
 */

namespace GrahamCampbell\BootstrapCMS\Controllers;

use Carbon\Carbon;
use GrahamCampbell\Binput\Facades\Binput;
use GrahamCampbell\BootstrapCMS\Facades\EventProvider;
use GrahamCampbell\Credentials\Facades\Credentials;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * This is the event controller class.
 *
 * @package    Bootstrap-CMS
 * @author     Graham Campbell
 * @copyright  Copyright (C) 2013-2014  Graham Campbell
 * @license    https://github.com/GrahamCampbell/Bootstrap-CMS/blob/master/LICENSE.md
 * @link       https://github.com/GrahamCampbell/Bootstrap-CMS
 */
class EventController extends AbstractController
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->setPermissions(array(
            'create'  => 'edit',
            'store'   => 'edit',
            'edit'    => 'edit',
            'update'  => 'edit',
            'destroy' => 'edit',
        ));

        parent::__construct();
    }

    /**
     * Display a listing of the events.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $events = EventProvider::paginate();
        $links = EventProvider::links();

        return View::make('events.index', array('events' => $events, 'links' => $links));
    }

    /**
     * Show the form for creating a new event.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return View::make('events.create');
    }

    /**
     * Store a new event.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $input = array_merge(array('user_id' => Credentials::getuser()->id), Binput::only(array(
            'title', 'location', 'date', 'body'
        )));

        $val = EventProvider::validate($input, array_keys($input));
        if ($val->fails()) {
            return Redirect::route('events.create')->withInput()->withErrors($val->errors());
        }

        $input['date'] = Carbon::createFromFormat('d/m/Y H:i', $input['date']);

        $event = EventProvider::create($input);

        return Redirect::route('events.show', array('events' => $event->id))
            ->with('success', 'Your event has been created successfully.');
    }

    /**
     * Show the specified event.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $event = EventProvider::find($id);
        $this->checkEvent($event);

        return View::make('events.show', array('event' => $event));
    }

    /**
     * Show the form for editing the specified event.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $event = EventProvider::find($id);
        $this->checkEvent($event);

        return View::make('events.edit', array('event' => $event));
    }

    /**
     * Update an existing event.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $input = Binput::only(array('title', 'location', 'date', 'body'));

        $val = $val = EventProvider::validate($input, array_keys($input));
        if ($val->fails()) {
            return Redirect::route('events.edit', array('events' => $id))->withInput()->withErrors($val->errors());
        }

        $input['date'] = Carbon::createFromFormat('d/m/Y H:i', $input['date']);

        $event = EventProvider::find($id);
        $this->checkEvent($event);

        $event->update($input);

        return Redirect::route('events.show', array('events' => $event->id))
            ->with('success', 'Your event has been updated successfully.');
    }

    /**
     * Delete an existing event.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = EventProvider::find($id);
        $this->checkEvent($event);

        $event->delete();

        return Redirect::route('events.index')
            ->with('success', 'Your event has been deleted successfully.');
    }

    /**
     * Check the event model.
     *
     * @param  mixed  $event
     * @return void
     */
    protected function checkEvent($event)
    {
        if (!$event) {
            throw new NotFoundHttpException('Event Not Found');
        }
    }
}
