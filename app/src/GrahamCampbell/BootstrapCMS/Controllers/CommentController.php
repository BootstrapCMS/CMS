<?php namespace GrahamCampbell\BootstrapCMS\Controllers;

/**
 * This file is part of Bootstrap CMS by Graham Campbell.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * @package    Bootstrap-CMS
 * @author     Graham Campbell
 * @license    GNU AFFERO GENERAL PUBLIC LICENSE
 * @copyright  Copyright (C) 2013  Graham Campbell
 * @link       https://github.com/GrahamCampbell/Bootstrap-CMS
 */

use App;
use Response;
use Validator;

use Binput;
use HTMLMin;

use CommentProvider;
use GrahamCampbell\CMSCore\Models\Comment;

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
        $this->checkAjax();

        $input = array(
            'body'    => Binput::get('body'),
            'user_id' => $this->getUserId(),
            'post_id' => $post_id
        );

        $rules = Comment::$rules;

        $val = Validator::make($input, $rules);
        if ($val->fails()) {
            App::abort(400, 'Your comment was empty.');
        }

        $comment = CommentProvider::create($input);

        return Response::json(array('success' => true, 'msg' => 'Comment created successfully.', 'comment' => HTMLMin::make('posts.comment', array('comment' => $comment, 'post_id' => $comment->getPostId()))));
    }

    /**
     * Update an existing comment.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($post_id, $id) {
        $this->checkAjax();

        $input = array('body' => Binput::get('value'));

        $rules = array('body' => Comment::$rules['body']);

        $val = Validator::make($input, $rules);
        if ($val->fails()) {
            App::abort(400, 'The comment was empty.');
        }

        $comment = CommentProvider::find($id);
        $this->checkComment($comment);

        $comment->update($input);

        return Response::json(array('success' => true, 'msg' => 'Comment updated successfully.'));
    }

    /**
     * Delete an existing comment.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($post_id, $id) {
        $this->checkAjax();

        $comment = CommentProvider::find($id);
        $this->checkComment($comment);

        $comment->delete();

        return Response::json(array('success' => true, 'msg' => 'Comment deleted successfully.', 'comment' => $id));
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
