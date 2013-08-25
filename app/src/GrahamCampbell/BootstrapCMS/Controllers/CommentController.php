<?php namespace GrahamCampbell\BootstrapCMS\Controllers;

use App;
use Redirect;
use Session;
use Validator;

use Binput;

use CommentProvider;
use GrahamCampbell\BootstrapCMS\Models\Comment;

class CommentController extends BaseController {

    /**
     * Constructor (setup access permissions).
     *
     * @return void
     */
    public function __construct() {
        $this->setPermissions(array(
            'store'   => 'user',
            'update'  => 'mod',
            'destroy' => 'mod',
        ));

        parent::__construct();
    }

    /**
     * Store a new comment.
     *
     * @return \Illuminate\Http\Response
     */
    public function store($post_id) {
        $input = array(
            'body'    => Binput::get('body'), // use the protected version this time
            'user_id' => $this->getUserId(),
            'post_id' => $post_id,
        );

        $rules = Comment::$rules;

        $val = Validator::make($input, $rules);
        if ($val->fails()) {
            Session::flash('error', 'Your comment was empty.');
            return Redirect::route('blog.posts.show', array('posts' => $post_id));
        }

        CommentProvider::create($input);

        Session::flash('success', 'Your post has been created successfully.');
        return Redirect::route('blog.posts.show', array('posts' => $post_id));
    }

    /**
     * Update an existing comment.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($post_id, $id) {
        $input = array(
            'body' => Binput::get('body', null, true, false), // no xss protection please
        );

        $rules = Comment::$rules;
        unset($rules['user_id']);
        unset($rules['post_id']);

        $val = Validator::make($input, $rules);
        if ($val->fails()) {
            Session::flash('error', 'The comment was empty.');
            return Redirect::route('blog.posts.show', array('posts' => $post_id));
        }

        $comment = CommentProvider::find($id);
        $this->checkComment($comment);

        $comment->update($input);
        
        Session::flash('success', 'The comment has been updated successfully.');
        return Redirect::route('blog.posts.show', array('posts' => $post_id));
    }

    /**
     * Delete an existing comment.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($post_id, $id) {
        $comment = CommentProvider::find($id);
        $this->checkComment($comment);

        $comment->delete();

        Session::flash('success', 'The comment has been deleted successfully.');
        return Redirect::route('blog.posts.show', array('posts' => $post_id));
    }

    /**
     * Check the comment model.
     *
     * @return mixed
     */
    protected function checkComment($comment) {
        if (!$comment) {
            return App::abort(404, 'Comment Not Found');
        }
    }
}
