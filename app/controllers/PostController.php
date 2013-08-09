<?php

class PostController extends BaseController {

    protected $post;

    /**
     * Load the injected models.
     * Setup access permissions.
     */
    public function __construct(Page $page, Post $post) {
        $this->page = $page;
        $this->post = $post;

        $this->setPermissions(array(
            'create'  => 'blog',
            'store'   => 'blog',
            'edit'    => 'blog',
            'update'  => 'blog',
            'destroy' => 'blog',
        ));

        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $posts = $this->post->orderBy('id', 'desc')->get(array('id', 'title', 'summary', 'body'));
        return $this->viewMake('posts.index', array('posts' => $posts));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return $this->viewMake('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        $input = array(
            'title'   => Binput::get('title'),
            'summary' => Binput::get('summary'),
            'body'    => Input::get('body'), // use standard input method
            'user_id' => $this->getUserId(),
        );

        $rules = $this->post->rules;

        $val = Validator::make($input, $rules);
        if ($val->fails()) {
            return Redirect::route('blog.posts.create')->withInput()->withErrors($val->errors());
        }

        $post = $this->post->create($input);

        Session::flash('success', 'Your post has been created successfully.');
        return Redirect::route('blog.posts.show', array('posts' => $post->getId()));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        $post = $this->post->find($id);
        $this->checkPost($post);

        $comments = $post->getCommentsReversed();

        return $this->viewMake('posts.show', array('post' => $post, 'comments' => $comments));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $post = $this->post->find($id);
        $this->checkPost($post);

        return $this->viewMake('posts.edit', array('post' => $post));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        $input = array(
            'title'   => Binput::get('title'),
            'summary' => Binput::get('summary'),
            'body'    => Input::get('body'), // use standard input method
        );

        $rules = $this->post->rules;
        unset($rules['user_id']);

        $val = Validator::make($input, $rules);
        if ($val->fails()) {
            return Redirect::route('blog.posts.edit', array('posts' => $id))->withInput()->withErrors($val->errors());
        }

        $post = $this->post->find($id);
        $this->checkPost($post);

        $post->update($input);
        
        Session::flash('success', 'Your post has been updated successfully.');
        return Redirect::route('blog.posts.show', array('posts' => $post->getId()));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        $post = $this->post->find($id);
        $this->checkPost($post);

        $post->delete();

        Session::flash('success', 'Your post has been deleted successfully.');
        return Redirect::route('blog.posts.index');
    }

    protected function checkPost($post) {
        if (!$post) {
            return App::abort(404, 'Post Not Found');
        }
    }
}
