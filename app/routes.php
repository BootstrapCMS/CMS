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

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


// test routes
Route::get('hello', array('as' => 'hello', 'uses' => 'GrahamCampbell\BootstrapCMS\Controllers\HomeController@showWelcome'));
Route::get('test', array('as' => 'test', 'uses' => 'GrahamCampbell\BootstrapCMS\Controllers\HomeController@showTest'));
Route::get('testqueue', array('as' => 'testqueue', 'uses' => 'GrahamCampbell\BootstrapCMS\Controllers\HomeController@testQueue'));
Route::get('testerror', array('as' => 'testerror', 'uses' => 'GrahamCampbell\BootstrapCMS\Controllers\HomeController@testError'));


// send users to the home page
Route::get('/', array('as' => 'base', function () {
    Session::flash('', ''); // work around laravel bug if there is no session yet
    Session::reflash();
    return Redirect::route('pages.show', array('pages' => 'home'));
}));


// send users to the posts page
if (Config::get('cms.blogging')) {
    Route::get('blog', array('as' => 'blog', function () {
        Session::flash('', ''); // work around laravel bug if there is no session yet
        Session::reflash();
        return Redirect::route('blog.posts.index');
    }));
}


// send users to the sections page
if (Config::get('cms.storage')) {
    Route::get('storage', array('as' => 'storage', function () {
        Session::flash('', ''); // work around laravel bug if there is no session yet
        Session::reflash();
        return Redirect::route('storage.folders.index');
    }));
}


// page routes
Route::resource('pages', 'GrahamCampbell\BootstrapCMS\Controllers\PageController');


// blog routes
if (Config::get('cms.blogging')) {
    Route::resource('blog/posts', 'GrahamCampbell\BootstrapCMS\Controllers\PostController');
    Route::resource('blog/posts.comments', 'GrahamCampbell\BootstrapCMS\Controllers\CommentController');
}


// event routes
if (Config::get('cms.events')) {
    Route::resource('events', 'GrahamCampbell\BootstrapCMS\Controllers\EventController');
}


// storage routes
if (Config::get('cms.storage')) {
    Route::resource('storage/folders', 'GrahamCampbell\BootstrapCMS\Controllers\FolderController');
    Route::resource('storage/folders.files', 'GrahamCampbell\BootstrapCMS\Controllers\FileController');
}


// caching routes
Route::get('caching', array('as' => 'caching.index', 'uses' => 'GrahamCampbell\BootstrapCMS\Controllers\CachingController@getIndex'));


// queuing routes
Route::get('queuing', array('as' => 'queuing.index', 'uses' => 'GrahamCampbell\BootstrapCMS\Controllers\QueuingController@getIndex'));
