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

namespace GrahamCampbell\BootstrapCMS\Http\Controllers;

use GrahamCampbell\Binput\Facades\Binput;
use GrahamCampbell\BootstrapCMS\Facades\PostRepository;
use GrahamCampbell\Credentials\Facades\Credentials;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * This is the post controller class.
 *
 * @author    Graham Campbell <graham@mineuk.com>
 * @copyright 2013-2014 Graham Campbell
 * @license   <https://github.com/GrahamCampbell/Bootstrap-CMS/blob/master/LICENSE.md> AGPL 3.0
 */
class PostController extends AbstractController
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->setPermissions([
            'create'  => 'blog',
            'store'   => 'blog',
            'edit'    => 'blog',
            'update'  => 'blog',
            'destroy' => 'blog',
        ]);

        parent::__construct();
    }

    /**
     * Display a listing of the posts.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $posts = PostRepository::paginate();
        $links = PostRepository::links();

        return View::make('posts.index', ['posts' => $posts, 'links' => $links]);
    }

    /**
     * Show the form for creating a new post.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return View::make('posts.create');
    }

    /**
     * Store a new post.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $input = array_merge(['user_id' => Credentials::getuser()->id], Binput::only([
            'title', 'summary', 'body',
        ]));

        $val = PostRepository::validate($input, array_keys($input));
        if ($val->fails()) {
            return Redirect::route('blog.posts.create')->withInput()->withErrors($val->errors());
        }

        $post = PostRepository::create($input);

        return Redirect::route('blog.posts.show', ['posts' => $post->id])
            ->with('success', 'Your post has been created successfully.');
    }

    /**
     * Show the specified post.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $post = PostRepository::find($id);
        $this->checkPost($post);

        $comments = $post->comments()->orderBy('id', 'desc')->get();

        return View::make('posts.show', ['post' => $post, 'comments' => $comments]);
    }

    /**
     * Show the form for editing the specified post.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $post = PostRepository::find($id);
        $this->checkPost($post);

        return View::make('posts.edit', ['post' => $post]);
    }

    /**
     * Update an existing post.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $input = Binput::only(['title', 'summary', 'body']);

        $val = PostRepository::validate($input, array_keys($input));
        if ($val->fails()) {
            return Redirect::route('blog.posts.edit', ['posts' => $id])->withInput()->withErrors($val->errors());
        }

        $post = PostRepository::find($id);
        $this->checkPost($post);

        $post->update($input);

        return Redirect::route('blog.posts.show', ['posts' => $post->id])
            ->with('success', 'Your post has been updated successfully.');
    }

    /**
     * Delete an existing post.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = PostRepository::find($id);
        $this->checkPost($post);

        $post->delete();

        return Redirect::route('blog.posts.index')
            ->with('success', 'Your post has been deleted successfully.');
    }

    /**
     * Check the post model.
     *
     * @param mixed $post
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     *
     * @return void
     */
    protected function checkPost($post)
    {
        if (!$post) {
            throw new NotFoundHttpException('Post Not Found');
        }
    }
}
