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

use Illuminate\Support\Facades\Redirect;
use GrahamCampbell\Binput\Classes\Binput;
use GrahamCampbell\Viewer\Classes\Viewer;
use GrahamCampbell\BootstrapCMS\Providers\PostProvider;
use GrahamCampbell\Credentials\Classes\Credentials;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * This is the post controller class.
 *
 * @package    Bootstrap-CMS
 * @author     Graham Campbell
 * @copyright  Copyright (C) 2013-2014  Graham Campbell
 * @license    https://github.com/GrahamCampbell/Bootstrap-CMS/blob/master/LICENSE.md
 * @link       https://github.com/GrahamCampbell/Bootstrap-CMS
 */
class PostController extends AbstractController
{
    /**
     * The viewer instance.
     *
     * @var \GrahamCampbell\Viewer\Classes\Viewer
     */
    protected $viewer;

    /**
     * The binput instance.
     *
     * @var \GrahamCampbell\Binput\Classes\Binput
     */
    protected $binput;

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
     * @param  \GrahamCampbell\Viewer\Classes\Viewer  $viewer
     * @param  \GrahamCampbell\Binput\Classes\Binput  $binput
     * @param  \GrahamCampbell\BootstrapCMS\Providers\PostProvider  $postprovider
     * @return void
     */
    public function __construct(Credentials $credentials, Viewer $viewer, Binput $binput, PostProvider $postprovider)
    {
        $this->viewer = $viewer;
        $this->binput = $binput;
        $this->postprovider = $postprovider;

        $this->setPermissions(array(
            'create'  => 'blog',
            'store'   => 'blog',
            'edit'    => 'blog',
            'update'  => 'blog',
            'destroy' => 'blog',
        ));

        parent::__construct($credentials);
    }

    /**
     * Display a listing of the posts.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = $this->postprovider->paginate();
        $links = $this->postprovider->links();

        return $this->viewer->make('posts.index', array('posts' => $posts, 'links' => $links));
    }

    /**
     * Show the form for creating a new post.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->viewer->make('posts.create');
    }

    /**
     * Store a new post.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $input = array(
            'title'   => $this->binput->get('title'),
            'summary' => $this->binput->get('summary'),
            'body'    => $this->binput->get('body'),
            'user_id' => $this->getUserId(),
        );

        $val = $this->postprovider->validate($input, array_keys($input));
        if ($val->fails()) {
            return Redirect::route('blog.posts.create')->withInput()->withErrors($val->errors());
        }

        $post = $this->postprovider->create($input);

        return Redirect::route('blog.posts.show', array('posts' => $post->id))
            ->with('success', 'Your post has been created successfully.');
    }

    /**
     * Show the specified post.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = $this->postprovider->find($id);
        $this->checkPost($post);

        $comments = $post->comments()->orderBy('id', 'desc')->get();

        return $this->viewer->make('posts.show', array('post' => $post, 'comments' => $comments));
    }

    /**
     * Show the form for editing the specified post.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = $this->postprovider->find($id);
        $this->checkPost($post);

        return $this->viewer->make('posts.edit', array('post' => $post));
    }

    /**
     * Update an existing post.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $input = array(
            'title'   => $this->binput->get('title'),
            'summary' => $this->binput->get('summary'),
            'body'    => $this->binput->get('body', null, true, false), // no xss protection please
        );

        $val = $this->postprovider->validate($input, array_keys($input));
        if ($val->fails()) {
            return Redirect::route('blog.posts.edit', array('posts' => $id))->withInput()->withErrors($val->errors());
        }

        $post = $this->postprovider->find($id);
        $this->checkPost($post);

        $post->update($input);

        return Redirect::route('blog.posts.show', array('posts' => $post->id))
            ->with('success', 'Your post has been updated successfully.');
    }

    /**
     * Delete an existing post.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = $this->postprovider->find($id);
        $this->checkPost($post);

        $post->delete();

        return Redirect::route('blog.posts.index')
            ->with('success', 'Your post has been deleted successfully.');
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
     * Return the viewer instance.
     *
     * @return \GrahamCampbell\Viewer\Classes\Viewer
     */
    public function getViewer()
    {
        return $this->viewer;
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
     * Return the post provider instance.
     *
     * @return \GrahamCampbell\BootstrapCMS\Providers\PostProvider
     */
    public function getPostProvider()
    {
        return $this->postprovider;
    }
}
