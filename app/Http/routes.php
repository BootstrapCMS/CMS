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

 use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;

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

// send users to the home page
Route::get('/', ['as' => 'base', function () {
    Session::flash('', ''); // work around laravel bug if there is no session yet
    Session::reflash();
    return Redirect::to(Config::get('graham-campbell/core::home', 'pages/home'));
}, ]);

// send users to the posts page
if (Config::get('cms.blogging')) {
    Route::get('blog', ['as' => 'blog', function () {
        Session::flash('', ''); // work around laravel bug if there is no session yet
        Session::reflash();
        return Redirect::route('blog.posts.index');
    }, ]);
}

// page routes
Route::resource('pages', 'GrahamCampbell\BootstrapCMS\Http\Controllers\PageController');

// blog routes
if (Config::get('cms.blogging')) {
    Route::resource('blog/posts', 'GrahamCampbell\BootstrapCMS\Http\Controllers\PostController');
    Route::resource('blog/posts.comments', 'GrahamCampbell\BootstrapCMS\Http\Controllers\CommentController');
}

// event routes
if (Config::get('cms.events')) {
    Route::resource('events', 'GrahamCampbell\BootstrapCMS\Http\Controllers\EventController');
}

// caching routes
Route::get('caching', [
    'as' => 'caching.index',
    'uses' => 'GrahamCampbell\BootstrapCMS\Http\Controllers\CachingController@getIndex',
]);

/*
|--------------------------------------------------------------------------
| Throttling Filters
|--------------------------------------------------------------------------
|
| This is where we check the user is not spamming our system by limiting
| certain types of actions with a throttler.
|
*/

Route::filter('throttle.comment', function ($route, $request) {
    // check if we've reached the rate limit, but don't hit the throttle yet
    // we can hit the throttle later on in the if validation passes
    if (!Throttle::check($request, 10, 1)) {
        throw new TooManyRequestsHttpException(60, 'Rate limit exceed.');
    }
});
