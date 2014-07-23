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

use GrahamCampbell\Binput\Binput;
use GrahamCampbell\BootstrapCMS\Providers\CommentProvider;
use GrahamCampbell\BootstrapCMS\Providers\PostProvider;
use GrahamCampbell\Credentials\Credentials;
use GrahamCampbell\Throttle\Throttlers\ThrottlerInterface;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;
use Illuminate\View\Factory;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
     * The throttler instance.
     *
     * @var \GrahamCampbell\Throttle\Throttlers\ThrottlerInterface
     */
    protected $throttler;

    /**
     * Create a new instance.
     *
     * @param  \GrahamCampbell\Credentials\Credentials  $credentials
     * @param  \Illuminate\View\Factory  $view
     * @param  \Illuminate\Session\SessionManager  $session
     * @param  \GrahamCampbell\Binput\Binput  $binput
     * @param  \GrahamCampbell\BootstrapCMS\Providers\CommentProvider  $commentprovider
     * @param  \GrahamCampbell\BootstrapCMS\Providers\PostProvider  $postprovider
     * @param  \GrahamCampbell\Throttle\Throttlers\ThrottlerInterface  $throttler
     * @return void
     */
    public function __construct(
        Credentials $credentials,
        Factory $view,
        SessionManager $session,
        Binput $binput,
        CommentProvider $commentprovider,
        PostProvider $postprovider,
        ThrottlerInterface $throttler
    ) {
        $this->session = $session;
        $this->binput = $binput;
        $this->commentprovider = $commentprovider;
        $this->postprovider = $postprovider;
        $this->throttler = $throttler;

        $this->setPermissions(array(
            'store'   => 'user',
            'update'  => 'mod',
            'destroy' => 'mod',
        ));

        $this->beforeFilter('ajax');
        $this->beforeFilter('throttle.comment', array('only' => array('store')));

        parent::__construct($credentials, $view);
    }

    /**
     * Display a listing of the comments.
     *
     * @param  int  $postId
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($postId)
    {
        $post = $this->postprovider->find($postId, array('id'));
        if (!$post) {
            $this->session->flash('error', 'The post you were viewing has been deleted.');
            return Response::json(array(
                'success' => false,
                'code' => 404,
                'msg' => 'The post you were viewing has been deleted.',
                'url' => URL::route('blog.posts.index')
            ), 404);
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
     * @param  int  $postId
     * @return \Illuminate\Http\JsonResponse
     */
    public function store($postId)
    {
        $input = array_merge($this->binput->only('body'), array(
            'user_id' => $this->getUserId(),
            'postId' => $postId,
            'version' => 1
        ));

        if ($this->commentprovider->validate($input, array_keys($input))->fails()) {
            throw new BadRequestHttpException('Your comment was empty.');
        }

        $this->throttler->hit();

        $comment = $this->commentprovider->create($input);

        $contents = $this->view->make('posts.comment', array(
            'comment' => $comment,
            'postId' => $postId
        ));

        return Response::json(array(
            'success' => true,
            'msg' => 'Comment created successfully.',
            'contents' => $contents->render(),
            'comment_id' => $comment->id
        ), 201);
    }

    /**
     * Show the specified post.
     *
     * @param  int  $postId
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($postId, $id)
    {
        $comment = $this->commentprovider->find($id);
        $this->checkComment($comment);

        $contents = $this->view->make('posts.comment', array(
            'comment' => $comment,
            'postId' => $postId
        ));

        return Response::json(array(
            'contents' => $contents->render(),
            'comment_text' => nl2br(e($comment->body)),
            'comment_id' => $id,
            'comment_ver' => $comment->version
        ));
    }

    /**
     * Update an existing comment.
     *
     * @param  int  $postId
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($postId, $id)
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

        $version++;

        $comment->update(array_merge($input, array('version' => $version)));

        return Response::json(array(
            'success' => true,
            'msg' => 'Comment updated successfully.',
            'comment_text' => nl2br(e($comment->body)),
            'comment_id' => $id,
            'comment_ver' => $version
        ));
    }

    /**
     * Delete an existing comment.
     *
     * @param  int  $postId
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($postId, $id)
    {
        $comment = $this->commentprovider->find($id);
        $this->checkComment($comment);

        $comment->delete();

        return Response::json(array(
            'success' => true,
            'msg' => 'Comment deleted successfully.',
            'comment_id' => $id
        ));
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
