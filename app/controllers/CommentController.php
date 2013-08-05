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
        return Redirect::route('blog.posts.show', array('posts' => $post_id));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store($post_id) {
        $input = array(
            'body'    => Binput::get('body'), // use the protected version this time
            'user_id' => $this->getUserId(),
            'post_id' => $post_id,
        );

        $rules = $this->comment->rules;

        $v = Validator::make($input, $rules);
        if ($v->fails()) {
            Session::flash('error', 'Your comment was empty.');
            return Redirect::route('blog.posts.show', array('posts' => $post_id));
        } else {
            $post = $this->comment->create($input);

            Session::flash('success', 'Your post has been created successfully.');
            return Redirect::route('blog.posts.show', array('posts' => $post_id));
        }
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
        return Redirect::route('blog.posts.show', array('posts' => $post_id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($post_id, $id) {
        $input = array(
            'body' => Input::get('body'), // use standard input method
        );

        $rules = $this->comment->rules;
        unset($rules['user_id']);
        unset($rules['post_id']);

        $v = Validator::make($input, $rules);
        if ($v->fails()) {
            Session::flash('error', 'The comment was empty.');
            return Redirect::route('blog.posts.show', array('posts' => $post_id));
        } else {
            $comment = $this->comment->find($id);

            if (!$comment) {
                App::abort(404, 'Comment Not Found');
            }

            $comment->update($input);
            
            Session::flash('success', 'Your post has been updated successfully.');
            return Redirect::route('blog.posts.show', array('posts' => $post_id));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($post_id, $id) {
        $comment = $this->comment->find($id);

        if (!$comment) {
            App::abort(404, 'Comment Not Found');
        }

        $comment->delete();

        Session::flash('success', 'The comment has been deleted successfully.');
        return Redirect::route('blog.posts.show', array('posts' => $post_id));
    }
}
