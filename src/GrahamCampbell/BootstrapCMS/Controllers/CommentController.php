<?php

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
 */

namespace GrahamCampbell\BootstrapCMS\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use GrahamCampbell\Binput\Facades\Binput;
use GrahamCampbell\HTMLMin\Facades\HTMLMin;
use GrahamCampbell\CMSCore\Models\Comment;
use GrahamCampbell\CMSCore\Facades\CommentProvider;
use GrahamCampbell\CMSCore\Facades\PostProvider;
use GrahamCampbell\CMSCore\Controllers\AbstractController;

/**
 * This is the comment controller class.
 *
 * @package    Bootstrap-CMS
 * @author     Graham Campbell
 * @copyright  Copyright (C) 2013-2014  Graham Campbell
 * @license    https://github.com/GrahamCampbell/Bootstrap-CMS/blob/master/LICENSE.md
 * @link       https://github.com/GrahamCampbell/Bootstrap-CMS
 */
class CommentController extends AbstractController
{
    /**
     * Constructor (setup access permissions).
     *
     * @return void
     */
    public function __construct()
    {
        $this->setPermissions(array(
            'store'   => 'user',
            'update'  => 'mod',
            'destroy' => 'mod',
        ));

        parent::__construct();
    }

    /**
     * Display a listing of the comments.
     *
     * @param  int  $post_id
     * @return \Illuminate\Http\Response
     */
    public function index($post_id)
    {
        $this->checkAjax();

        $post = PostProvider::find($post_id, array('id'));
        if (!$post) {
            Session::flash('error', 'The post you were viewing has been deleted.');
            return Response::json(array('success' => false, 'code' => 404, 'msg' => 'The post you were viewing has been deleted.', 'url' => URL::route('blog.posts.index')), 404);
        }

        $comments = $post->getComments(array('id', 'version'));

        $data = array();

        foreach ($comments as $comment) {
            $data[] = array('comment_id' => $comment->getId(), 'comment_ver' => $comment->getVersion());
        }

        return Response::json(array_reverse($data));
    }

    /**
     * Store a new comment.
     *
     * @param  int  $post_id
     * @return \Illuminate\Http\Response
     */
    public function store($post_id)
    {
        $this->checkAjax();

        $input = array(
            'body'    => Binput::get('body'),
            'user_id' => $this->getUserId(),
            'post_id' => $post_id,
            'version' => 1
        );

        $rules = Comment::$rules;

        $val = Validator::make($input, $rules);
        if ($val->fails()) {
            App::abort(400, 'Your comment was empty.');
        }

        $comment = CommentProvider::create($input);

        return Response::json(array('success' => true, 'msg' => 'Comment created successfully.', 'contents' => HTMLMin::make('posts.comment', array('comment' => $comment, 'post_id' => $post_id)), 'comment_id' => $comment->getId()));
    }

    /**
     * Show the specified post.
     *
     * @param  int  $post_id
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($post_id, $id)
    {
        $this->checkAjax();

        $comment = CommentProvider::find($id);
        $this->checkComment($comment);

        return Response::json(array('contents' => HTMLMin::make('posts.comment', array('comment' => $comment, 'post_id' => $post_id)), 'comment_text' => HTMLMin::render(nl2br(e($comment->getBody()))),'comment_id' => $id, 'comment_ver' => $comment->getVersion()));
    }

    /**
     * Update an existing comment.
     *
     * @param  int  $post_id
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($post_id, $id)
    {
        $this->checkAjax();

        $input = array('body' => Binput::get('edit_body'));

        $rules = array('body' => Comment::$rules['body']);

        $val = Validator::make($input, $rules);
        if ($val->fails()) {
            App::abort(400, 'The comment was empty.');
        }

        $comment = CommentProvider::find($id);
        $this->checkComment($comment);

        $version = Binput::get('version');

        $val = Validator::make(array('version' => $version), array('version' => 'required'));
        if ($val->fails()) {
            App::abort(400, 'No version data was supplied.');
        }

        if ($version != $comment->getVersion() && $version) {
            App::abort(409, 'The comment was modified by someone else.');
        }

        $version = $version+1;

        $comment->update(array_merge($input, array('version' => $version)));

        return Response::json(array('success' => true, 'msg' => 'Comment updated successfully.', 'comment_text' => HTMLMin::render(nl2br(e($comment->getBody()))),'comment_id' => $id, 'comment_ver' => $version));
    }

    /**
     * Delete an existing comment.
     *
     * @param  int  $post_id
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($post_id, $id)
    {
        $this->checkAjax();

        $comment = CommentProvider::find($id);
        $this->checkComment($comment);

        $comment->delete();

        return Response::json(array('success' => true, 'msg' => 'Comment deleted successfully.', 'comment_id' => $id));
    }

    /**
     * Check the comment model.
     *
     * @param  mixed  $comment
     * @return void
     */
    protected function checkComment($comment)
    {
        if (!$comment) {
            return App::abort(404, 'Comment Not Found');
        }
    }

    /**
     * Check the post model.
     *
     * @param  mixed  $post
     * @return void
     */
    protected function checkPost($post)
    {
        if (!$post) {
            return App::abort(404, 'Post Not Found');
        }
    }
}
