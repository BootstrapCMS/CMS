<?php

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
Route::get('test', array('as' => 'test', 'uses' => 'HomeController@showWelcome'));
Route::get('testqueue', array('as' => 'testqueue', 'uses' => 'HomeController@testQueue'));
Route::get('log/{file}', array('as' => 'log', 'uses' => 'HomeController@showLog'));


// send users to the home page
Route::get('/', array('as' => 'base', function() {
    Session::flash('', ''); // work around laravel bug
    Session::reflash();
    Log::info('Redirecting from / to the home page');
    return Redirect::route('pages.show', array('pages' => 'home'));
}));


// account routes
Route::get('account', array('as' => 'account.index', 'uses' => 'AccountController@getIndex'));
Route::get('account/login', array('as' => 'account.login', 'uses' => 'AccountController@getLogin'));
Route::post('account/login', array('as' => 'account.login.post', 'uses' => 'AccountController@postLogin'));
Route::get('account/register', array('as' => 'account.register', 'uses' => 'AccountController@getRegister'));
Route::post('account/register', array('as' => 'account.register.post', 'uses' => 'AccountController@postRegister'));
Route::get('account/profile', array('as' => 'account.profile', 'uses' => 'AccountController@getProfile'));
Route::put('account/profile', array('as' => 'account.profile.put', 'uses' => 'AccountController@putProfile'));
Route::get('account/reset', array('as' => 'account.reset', 'uses' => 'AccountController@getReset'));
Route::post('account/reset', array('as' => 'account.reset.post', 'uses' => 'AccountController@postReset'));
Route::get('account/password/{id}/{code}', array('as' => 'account.password', 'uses' => 'AccountController@getPassword'));
Route::get('account/activate/{id}/{code}', array('as' => 'account.activate', 'uses' => 'AccountController@getActivate'));
Route::get('account/logout', array('as' => 'account.logout', 'uses' => 'AccountController@getLogout'));


// users routes
Route::resource('users', 'UserController');

// config routes
Route::resource('config', 'ConfigController');

// pages routes
Route::resource('pages', 'PageController');

// events routes
Route::resource('events', 'EventController');

// blog routes
Route::resource('blogs', 'BlogController');
Route::resource('blogs.comments', 'CommentController');
