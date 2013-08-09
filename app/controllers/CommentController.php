<?php

class CommentController extends BaseController {

    protected $comment;

    /**
     * Load the injected models.
     * Setup access permissions.
     */
    public function __construct(Page $page, Comment $comment) {
        $this->page    = $page;
        $this->comment = $comment;

        $this->setPermissions(array(
            'store'   => 'user',
            'update'  => 'mod',
            'destroy' => 'mod',
        ));

        parent::__construct();
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

        $val = Validator::make($input, $rules);
        if ($val->fails()) {
            Session::flash('error', 'Your comment was empty.');
            return Redirect::route('blog.posts.show', array('posts' => $post_id));
        }

        $this->comment->create($input);

        Session::flash('success', 'Your post has been created successfully.');
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

        $val = Validator::make($input, $rules);
        if ($val->fails()) {
            Session::flash('error', 'The comment was empty.');
            return Redirect::route('blog.posts.show', array('posts' => $post_id));
        }

        $comment = $this->comment->find($id);
        $this->checkComment($comment);

        $comment->update($input);
        
        Session::flash('success', 'The comment has been updated successfully.');
        return Redirect::route('blog.posts.show', array('posts' => $post_id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($post_id, $id) {
        $comment = $this->comment->find($id);
        $this->checkComment($comment);

        $comment->delete();

        Session::flash('success', 'The comment has been deleted successfully.');
        return Redirect::route('blog.posts.show', array('posts' => $post_id));
    }

    protected function checkComment($comment) {
        if (!$comment) {
            return App::abort(404, 'Comment Not Found');
        }
    }
}
