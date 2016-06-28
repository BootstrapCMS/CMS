<?php

/*
 * This file is part of Bootstrap CMS.
 *
 * (c) Graham Campbell <graham@alt-three.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\BootstrapCMS\Http\Controllers;

use Carbon\Carbon;
use GrahamCampbell\Binput\Facades\Binput;
use GrahamCampbell\BootstrapCMS\Facades\EventRepository;
use GrahamCampbell\Credentials\Facades\Credentials;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * This is the event controller class.
 *
 * @author Graham Campbell <graham@alt-three.com>
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
        $this->setPermissions([
            'create'  => 'edit',
            'store'   => 'edit',
            'edit'    => 'edit',
            'update'  => 'edit',
            'destroy' => 'edit',
        ]);

        parent::__construct();
    }

    /**
     * Display a listing of the events.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $events = EventRepository::paginate();
        $links = EventRepository::links();

        return View::make('events.index', ['events' => $events, 'links' => $links]);
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
        $input = array_merge(['user_id' => Credentials::getuser()->id], Binput::only([
            'title', 'location', 'date', 'body',
        ]));

        $val = EventRepository::validate($input, array_keys($input));
        if ($val->fails()) {
            return Redirect::route('events.create')->withInput()->withErrors($val->errors());
        }

        $input['date'] = Carbon::createFromFormat(Config::get('date.php_format'), $input['date']);

        $event = EventRepository::create($input);

        return Redirect::route('events.show', ['events' => $event->id])
            ->with('success', trans('messages.event.store_success'));
    }

    /**
     * Show the specified event.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $event = EventRepository::find($id);
        $this->checkEvent($event);

        return View::make('events.show', ['event' => $event]);
    }

    /**
     * Show the form for editing the specified event.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $event = EventRepository::find($id);
        $this->checkEvent($event);

        return View::make('events.edit', ['event' => $event]);
    }

    /**
     * Update an existing event.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $input = Binput::only(['title', 'location', 'date', 'body']);

        $val = $val = EventRepository::validate($input, array_keys($input));
        if ($val->fails()) {
            return Redirect::route('events.edit', ['events' => $id])->withInput()->withErrors($val->errors());
        }

        $input['date'] = Carbon::createFromFormat(Config::get('date.php_format'), $input['date']);

        $event = EventRepository::find($id);
        $this->checkEvent($event);

        $event->update($input);

        return Redirect::route('events.show', ['events' => $event->id])
            ->with('success', trans('messages.event.update_success'));
    }

    /**
     * Delete an existing event.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = EventRepository::find($id);
        $this->checkEvent($event);

        $event->delete();

        return Redirect::route('events.index')
            ->with('success', trans('messages.event.delete_success'));
    }

    /**
     * Check the event model.
     *
     * @param mixed $event
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     *
     * @return void
     */
    protected function checkEvent($event)
    {
        if (!$event) {
            throw new NotFoundHttpException('Event Not Found');
        }
    }
}
