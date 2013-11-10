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
use Redirect;
use Session;
use Validator;

use Binput;

use PostProvider;
use GrahamCampbell\CMSCore\Models\Post;

use GrahamCampbell\CMSCore\Controllers\BaseController;

class PostController extends BaseController {

    /**
     * Constructor (setup access permissions).
     *
     * @return void
     */
    public function __construct() {
        $this->setPermissions(array(
            'create'  => 'blog',
            'store'   => 'blog',
            'edit'    => 'blog',
            'update'  => 'blog',
            'destroy' => 'blog',
        ));

        parent::__construct();
    }

    /**
     * Display a listing of the posts.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $posts = PostProvider::paginate();
        $links = PostProvider::links();

        return $this->viewMake('posts.index', array('posts' => $posts, 'links' => $links));
    }

    /**
     * Show the form for creating a new post.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return $this->viewMake('posts.create');
    }

    /**
     * Store a new post.
     *
     * @return \Illuminate\Http\Response
     */
    public function store() {
        $input = array(
            'title'   => Binput::get('title'),
            'summary' => Binput::get('summary'),
            'body'    => Binput::get('body'),
            'user_id' => $this->getUserId(),
        );

        $rules = Post::$rules;

        $val = Validator::make($input, $rules);
        if ($val->fails()) {
            return Redirect::route('blog.posts.create')->withInput()->withErrors($val->errors());
        }

        $post = PostProvider::create($input);

        Session::flash('success', 'Your post has been created successfully.');
        return Redirect::route('blog.posts.show', array('posts' => $post->getId()));
    }

    /**
     * Show the specified post.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $post = PostProvider::find($id);
        $this->checkPost($post);

        $comments = $post->getComments();

        return $this->viewMake('posts.show', array('post' => $post, 'comments' => $comments));
    }

    /**
     * Show the form for editing the specified post.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $post = PostProvider::find($id);
        $this->checkPost($post);

        return $this->viewMake('posts.edit', array('post' => $post));
    }

    /**
     * Update an existing post.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id) {
        $input = array(
            'title'   => Binput::get('title'),
            'summary' => Binput::get('summary'),
            'body'    => Binput::get('body', null, true, false), // no xss protection please
        );

        $rules = Post::$rules;
        unset($rules['user_id']);

        $val = Validator::make($input, $rules);
        if ($val->fails()) {
            return Redirect::route('blog.posts.edit', array('posts' => $id))->withInput()->withErrors($val->errors());
        }

        $post = PostProvider::find($id);
        $this->checkPost($post);

        $post->update($input);
        
        Session::flash('success', 'Your post has been updated successfully.');
        return Redirect::route('blog.posts.show', array('posts' => $post->getId()));
    }

    /**
     * Delete an existing post.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $post = PostProvider::find($id);
        $this->checkPost($post);

        $post->delete();

        Session::flash('success', 'Your post has been deleted successfully.');
        return Redirect::route('blog.posts.index');
    }

    /**
     * Check the post model.
     *
     * @return mixed
     */
    protected function checkPost($post) {
        if (!$post) {
            return App::abort(404, 'Post Not Found');
        }
    }
}
