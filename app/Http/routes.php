<?php

/*
 * This file is part of Bootstrap CMS.
 *
 * (c) Graham Campbell <graham@alt-three.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// send users to the home page
$router->get('/', ['as' => 'base', function () {
    Session::flash('', ''); // work around laravel bug if there is no session yet
    Session::reflash();

    return Redirect::to('pages/home');
}]);

// send users to the posts page
if (Config::get('cms.blogging')) {
    $router->get('blog', ['as' => 'blog', function () {
        Session::flash('', ''); // work around laravel bug if there is no session yet
        Session::reflash();

        return Redirect::route('blog.posts.index');
    }]);
}

// page routes
$router->resource('pages', 'PageController');

// blog routes
if (Config::get('cms.blogging')) {
    $router->resource('blog/posts', 'PostController');
    $router->resource('blog/posts.comments', 'CommentController');
}

// event routes
if (Config::get('cms.events')) {
    $router->resource('events', 'EventController');
}
