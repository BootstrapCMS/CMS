<?php

class EventController extends BaseController {

    protected $event;

    /**
     * Load the injected models.
     * Setup access permissions.
     */
    public function __construct(Page $page, Event $event) {
        $this->page  = $page;
        $this->event = $event;

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
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $events = array(); // temporary
        //$events = $this->event->getUpcoming();

        return $this->viewMake('events.index', array('events' => $events));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return 'events create';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        return 'events store';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        return 'events show '.$id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        return 'events edit '.$id;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        return 'events update '.$id;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        return 'events destroy '.$id;
    }

    protected function checkEvent($event) {
        if (!$event) {
            return App::abort(404, 'Event Not Found');
        }
    }
}
