<?php

class BlogController extends BaseController {

    protected $blog;

    /**
     * Load the injected models.
     * Setup access permissions.
     */
    public function __construct(Page $page, Blog $blog) {
        $this->page = $page;
        $this->blog = $blog;

        $this->blogs[] = 'create';
        $this->blogs[] = 'store';
        $this->blogs[] = 'edit';
        $this->blogs[] = 'update';
        $this->blogs[] = 'destroy';

        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        return 'blogs index';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return 'blogs create';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        return 'blogs store';
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return Response
     */
    public function show($slug) {
        //if (!preg_match('/^[0-9]{1,}$/', $id))
        return 'blogs show '.$slug;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $slug
     * @return Response
     */
    public function edit($slug) {
        return 'blogs edit '.$slug;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  string  $slug
     * @return Response
     */
    public function update($slug) {
        return 'blogs update '.$slug;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $slug
     * @return Response
     */
    public function destroy($slug) {
        return 'blogs destroy '.$slug;
    }
}
