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

        $v = Validator::make($input, $rules);
        if ($v->fails()) {
            return Redirect::route('blog.posts.create')->withInput()->withErrors($v->errors());
        } else {
            $post = $this->post->create($input);

            Session::flash('success', 'Your post has been created successfully.');
            return Redirect::route('blog.posts.show', array('posts' => $post->getId()));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        $post = $this->post->find($id);

        if (!$post) {
            App::abort(404, 'Post Not Found');
        }

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

        if (!$post) {
            App::abort(404, 'Post Not Found');
        }

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

        $v = Validator::make($input, $rules);
        if ($v->fails()) {
            return Redirect::route('blog.posts.edit', array('posts' => $id))->withInput()->withErrors($v->errors());
        } else {
            $post = $this->post->find($id);

            if (!$post) {
                App::abort(404, 'Post Not Found');
            }

            $post->update($input);
            
            Session::flash('success', 'Your post has been updated successfully.');
            return Redirect::route('blog.posts.show', array('posts' => $post->getId()));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        $post = $this->post->find($id);

        if (!$post) {
            App::abort(404, 'Post Not Found');
        }

        $post->delete();

        Session::flash('success', 'Your post has been deleted successfully.');
        return Redirect::route('blog.posts.index');
    }
}
