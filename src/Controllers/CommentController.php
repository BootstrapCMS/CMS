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

use Illuminate\View\Factory;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;
use GrahamCampbell\Binput\Binput;
use GrahamCampbell\BootstrapCMS\Providers\CommentProvider;
use GrahamCampbell\BootstrapCMS\Providers\PostProvider;
use GrahamCampbell\Credentials\Credentials;
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
     * @var \GrahamCampbell\Binput\Binput
     */
    protected $binput;

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
     * @param  \GrahamCampbell\Credentials\Credentials  $credentials
     * @param  \Illuminate\View\Factory  $view
     * @param  \Illuminate\Session\SessionManager  $session
     * @param  \GrahamCampbell\Binput\Binput  $binput
     * @param  \GrahamCampbell\BootstrapCMS\Providers\CommentProvider  $commentprovider
     * @param  \GrahamCampbell\BootstrapCMS\Providers\PostProvider  $postprovider
     * @return void
     */
    public function __construct(Credentials $credentials, Factory $view, SessionManager $session, Binput $binput, CommentProvider $commentprovider, PostProvider $postprovider)
    {
        $this->session = $session;
        $this->binput = $binput;
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

        parent::__construct($credentials, $view);
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
        $input = array_merge($this->binput->only('body'), array(
            'user_id' => $this->getUserId(),
            'post_id' => $post_id,
            'version' => 1
        ));

        if ($this->commentprovider->validate($input, array_keys($input))->fails()) {
            throw new BadRequestHttpException('Your comment was empty.');
        }

        $comment = $this->commentprovider->create($input);

        return Response::json(array('success' => true, 'msg' => 'Comment created successfully.', 'contents' => $this->view->make('posts.comment', array('comment' => $comment, 'post_id' => $post_id))->render(), 'comment_id' => $comment->id), 201);
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

        return Response::json(array('contents' => $this->view->make('posts.comment', array('comment' => $comment, 'post_id' => $post_id))->render(), 'comment_text' => nl2br(e($comment->body)), 'comment_id' => $id, 'comment_ver' => $comment->version));
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
        $input = $this->binput->map(array('edit_body' => 'body'));

        if ($this->commentprovider->validate($input, array_keys($input))->fails()) {
            throw new BadRequestHttpException('Your comment was empty.');
        }

        $comment = $this->commentprovider->find($id);
        $this->checkComment($comment);

        $version = $this->binput->get('version');

        if (empty($version)) {
            throw new BadRequestHttpException('No version data was supplied.');
        }

        if ($version != $comment->version && $version) {
            throw new ConflictHttpException('The comment was modified by someone else.');
        }

        $version = $version+1;

        $comment->update(array_merge($input, array('version' => $version)));

        return Response::json(array('success' => true, 'msg' => 'Comment updated successfully.', 'comment_text' => nl2br(e($comment->body)),'comment_id' => $id, 'comment_ver' => $version));
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
}
