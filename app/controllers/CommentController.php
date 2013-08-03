<?php

class CommentController extends BaseController {

    protected $comment;

    /**
     * Load the injected models.
     * Setup access permissions.
     */
    public function __construct(Page $page, Comment $comment) {
        $this->page = $page;
        $this->comment = $comment;

        $this->users[] = 'create';
        $this->users[] = 'store';
        $this->mods[] = 'edit';
        $this->mods[] = 'update';
        $this->mods[] = 'destroy';

        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        return 'comments index';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return 'comments create';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        return 'comments store';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($slug, $id) {
        return 'comments show '.$id.' from blog ' . $slug;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($slug, $id) {
        return 'comments edit '.$id.' from blog ' . $slug;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($slug, $id) {
        return 'comments update '.$id.' from blog ' . $slug;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($slug, $id) {
        return 'comments destroy '.$id.' from blog ' . $slug;
    }
}
