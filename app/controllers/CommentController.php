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
    public function index($post_id) {
        return Redirect::route('blog.posts.show', array('posts' => $post_id));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($post_id) {
        return 'comments create';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store($post_id) {
        return 'comments store';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($post_id, $id) {
        return Redirect::route('blog.posts.show', array('posts' => $post_id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($post_id, $id) {
        return 'comments edit '.$id.' from post ' . $post_id;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($post_id, $id) {
        return 'comments update '.$id.' from post ' . $post_id;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($post_id, $id) {
        return 'comments destroy '.$id.' from post ' . $post_id;
    }
}
