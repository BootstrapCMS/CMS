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

use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use GrahamCampbell\Binput\Classes\Binput;
use GrahamCampbell\HTMLMin\Classes\HTMLMin;
use GrahamCampbell\BootstrapCMS\Models\Comment;
use GrahamCampbell\BootstrapCMS\Providers\CommentProvider;
use GrahamCampbell\BootstrapCMS\Providers\PostProvider;
use GrahamCampbell\Credentials\Classes\Credentials;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

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
     * The session instance.
     *
     * @var \Illuminate\Session\SessionManager
     */
    protected $session;

    /**
     * The binput instance.
     *
     * @var \GrahamCampbell\Binput\Classes\Binput
     */
    protected $binput;

    /**
     * The htmlmin instance.
     *
     * @var \GrahamCampbell\HTMLMin\Classes\HTMLMin
     */
    protected $htmlmin;

    /**
     * The comment provider instance.
     *
     * @var \GrahamCampbell\BootstrapCMS\Providers\CommentProvider
     */
    protected $commentprovider;

    /**
     * The post provider instance.
     *
     * @var \GrahamCampbell\BootstrapCMS\Providers\PostProvider
     */
    protected $postprovider;

    /**
     * Create a new instance.
     *
     * @param  \GrahamCampbell\Credentials\Classes\Credentials  $credentials
     * @param  \Illuminate\Session\SessionManager  $session
     * @param  \GrahamCampbell\Binput\Classes\Binput  $binput
     * @param  \GrahamCampbell\HTMLMin\Classes\HTMLMin  $htmlmin
     * @param  \GrahamCampbell\BootstrapCMS\Providers\CommentProvider  $commentprovider
     * @param  \GrahamCampbell\BootstrapCMS\Providers\PostProvider  $postprovider
     * @return void
     */
    public function __construct(Credentials $credentials, SessionManager $session, Binput $binput, HTMLMin $htmlmin, CommentProvider $commentprovider, PostProvider $postprovider)
    {
        $this->session = $session;
        $this->binput = $binput;
        $this->htmlmin = $htmlmin;
        $this->commentprovider = $commentprovider;
        $this->postprovider = $postprovider;

        $this->setPermissions(array(
            'store'   => 'user',
            'update'  => 'mod',
            'destroy' => 'mod',
        ));

        $this->beforeFilter('ajax');
        $this->beforeFilter('throttle.comment.store', array('only' => array('store')));
        $this->beforeFilter('throttle.comment.update', array('only' => array('update')));

        parent::__construct($credentials);
    }

    /**
     * Display a listing of the comments.
     *
     * @param  int  $post_id
     * @return \Illuminate\Http\Response
     */
    public function index($post_id)
    {
        $post = $this->postprovider->find($post_id, array('id'));
        if (!$post) {
            $this->session->flash('error', 'The post you were viewing has been deleted.');
            return Response::json(array('success' => false, 'code' => 404, 'msg' => 'The post you were viewing has been deleted.', 'url' => URL::route('blog.posts.index')), 404);
        }

        $comments = $post->comments()->get(array('id', 'version'));

        $data = array();

        foreach ($comments as $comment) {
            $data[] = array('comment_id' => $comment->id, 'comment_ver' => $comment->version);
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
        $input = array(
            'body'    => $this->binput->get('body'),
            'user_id' => $this->getUserId(),
            'post_id' => $post_id,
            'version' => 1
        );

        $rules = Comment::$rules;

        $val = Validator::make($input, $rules);
        if ($val->fails()) {
            throw new BadRequestHttpException('Your comment was empty.');
        }

        $comment = $this->commentprovider->create($input);

        return Response::json(array('success' => true, 'msg' => 'Comment created successfully.', 'contents' => $this->htmlmin->make('posts.comment', array('comment' => $comment, 'post_id' => $post_id)), 'comment_id' => $comment->id));
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
        $comment = $this->commentprovider->find($id);
        $this->checkComment($comment);

        return Response::json(array('contents' => $this->htmlmin->make('posts.comment', array('comment' => $comment, 'post_id' => $post_id)), 'comment_text' => $this->htmlmin->render(nl2br(e($comment->body))),'comment_id' => $id, 'comment_ver' => $comment->version));
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
        $input = array('body' => $this->binput->get('edit_body'));

        $rules = array('body' => Comment::$rules['body']);

        $val = Validator::make($input, $rules);
        if ($val->fails()) {
            throw new BadRequestHttpException('Your comment was empty.');
        }

        $comment = $this->commentprovider->find($id);
        $this->checkComment($comment);

        $version = $this->binput->get('version');

        $val = Validator::make(array('version' => $version), array('version' => 'required'));
        if ($val->fails()) {
            throw new BadRequestHttpException('No version data was supplied.');
        }

        if ($version != $comment->version && $version) {
            throw new ConflictHttpException('The comment was modified by someone else.');
        }

        $version = $version+1;

        $comment->update(array_merge($input, array('version' => $version)));

        return Response::json(array('success' => true, 'msg' => 'Comment updated successfully.', 'comment_text' => $this->htmlmin->render(nl2br(e($comment->body))),'comment_id' => $id, 'comment_ver' => $version));
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
        $comment = $this->commentprovider->find($id);
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
            throw new NotFoundHttpException('Comment Not Found');
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
            throw new NotFoundHttpException('Post Not Found');
        }
    }

    /**
     * Return the session instance.
     *
     * @return \Illuminate\Session\SessionManager
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * Return the binput instance.
     *
     * @return \GrahamCampbell\Binput\Classes\Binput
     */
    public function getBinput()
    {
        return $this->binput;
    }

    /**
     * Return the htmlmin instance.
     *
     * @return \GrahamCampbell\HTMLMin\Classes\HTMLMin
     */
    public function getHTMLMin()
    {
        return $this->htmlmin;
    }

    /**
     * Return the comment provider instance.
     *
     * @return \GrahamCampbell\BootstrapCMS\Providers\CommentProvider
     */
    public function getCommentProvider()
    {
        return $this->commentprovider;
    }

    /**
     * Return the post provider instance.
     *
     * @return \GrahamCampbell\BootstrapCMS\Providers\PostProvider
     */
    public function getPostProvider()
    {
        return $this->postprovider;
    }
}
