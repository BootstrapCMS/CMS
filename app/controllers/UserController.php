<?php

class UserController extends BaseController {

    protected $user;

    /**
     * Load the injected models.
     * Setup access permissions.
     */
    public function __construct(Page $page, User $user) {
        $this->page = $page;
        $this->user = $user;

        $this->mods[] = 'index';
        $this->admins[] = 'create';
        $this->admins[] = 'store';
        $this->mods[] = 'show';
        $this->admins[] = 'edit';
        $this->admins[] = 'update';
        $this->admins[] = 'destroy';

        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $users = $this->user->orderBy('first_name')->get(array('id', 'first_name', 'last_name', 'email'));
        return $this->viewMake('users.index', array('users' => $users));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        $user = $this->user->find($id);

        if (!$user) {
            App::abort(404, 'User Not Found');
        }

        return $this->viewMake('users.show', array('user' => $user));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        $user = $this->user->find($id);

        if (!$user) {
            App::abort(404, 'User Not Found');
        }

        $user->delete();

        Session::flash('success', 'The user has been deleted successfully.');
        return Redirect::route('users.index');
    }
}
