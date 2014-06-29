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
use Illuminate\Support\Facades\Config;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\Redirect;
use GrahamCampbell\Binput\Binput;
use GrahamCampbell\BootstrapCMS\Providers\PageProvider;
use GrahamCampbell\Credentials\Credentials;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * This is the page controller class.
 *
 * @package    Bootstrap-CMS
 * @author     Graham Campbell
 * @copyright  Copyright (C) 2013-2014  Graham Campbell
 * @license    https://github.com/GrahamCampbell/Bootstrap-CMS/blob/master/LICENSE.md
 * @link       https://github.com/GrahamCampbell/Bootstrap-CMS
 */
class PageController extends AbstractController
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
     * The page provider instance.
     *
     * @var \GrahamCampbell\BootstrapCMS\Providers\PageProvider
     */
    protected $pageprovider;

    /**
     * Create a new instance.
     *
     * @param  \GrahamCampbell\Credentials\Credentials  $credentials
     * @param  \Illuminate\View\Factory  $view
     * @param  \Illuminate\Session\SessionManager  $session
     * @param  \GrahamCampbell\Binput\Binput  $binput
     * @param  \GrahamCampbell\BootstrapCMS\Providers\PageProvider  $pageprovider
     * @return void
     */
    public function __construct(Credentials $credentials, Factory $view, SessionManager $session, Binput $binput, PageProvider $pageprovider)
    {
        $this->session = $session;
        $this->binput = $binput;
        $this->pageprovider = $pageprovider;

        $this->setPermissions(array(
            'create'  => 'edit',
            'store'   => 'edit',
            'edit'    => 'edit',
            'update'  => 'edit',
            'destroy' => 'edit',
        ));

        parent::__construct($credentials, $view);
    }

    /**
     * Redirect to the homepage.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->session->flash('', ''); // work around laravel bug if there is no session yet
        $this->session->reflash();
        return Redirect::to(Config::get('graham-campbell/core::home', 'pages/home'));
    }

    /**
     * Show the form for creating a new page.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->view->make('pages.create');
    }

    /**
     * Store a new page.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $input = array_merge($this->getInput(), array('user_id' => $this->getUserId()));

        $val = $this->pageprovider->validate($input, array_keys($input));
        if ($val->fails()) {
            return Redirect::route('pages.create')->withInput()->withErrors($val->errors());
        }

        $page = $this->pageprovider->create($input);

        // write flash message and redirect
        return Redirect::route('pages.show', array('pages' => $page->slug))
            ->with('success', 'Your page has been created successfully.');
    }

    /**
     * Show the specified page.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $page = $this->pageprovider->find($slug);
        $this->checkPage($page, $slug);

        return $this->view->make('pages.show', array('page' => $page));
    }

    /**
     * Show the form for editing the specified page.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $page = $this->pageprovider->find($slug);
        $this->checkPage($page, $slug);

        return $this->view->make('pages.edit', array('page' => $page));
    }

    /**
     * Update an existing page.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function update($slug)
    {
        $input = $this->getInput();

        if (is_null($input['css']) || empty($input['css'])) {
            $input['css'] = '';
        }

        if (is_null($input['js']) || empty($input['js'])) {
            $input['js'] = '';
        }

        $val = $this->pageprovider->validate($input, array_keys($input));
        if ($val->fails()) {
            return Redirect::route('pages.edit', array('pages' => $slug))->withInput()->withErrors($val->errors());
        }

        $page = $this->pageprovider->find($slug);
        $this->checkPage($page, $slug);

        $checkupdate = $this->checkUpdate($input, $slug);
        if ($checkupdate) {
            return $checkupdate;
        }

        $page->update($input);

        // write flash message and redirect
        return Redirect::route('pages.show', array('pages' => $page->slug))
            ->with('success', 'Your page has been updated successfully.');
    }

    /**
     * Delete an existing page.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $page = $this->pageprovider->find($slug);
        $this->checkPage($page, $slug);

        try {
            $page->delete();
        } catch (\Exception $e) {
            return Redirect::route('pages.show', array('pages' => $page->slug))
                ->with('error', 'You cannot delete this page.');
        }

        // write flash message and redirect
        return Redirect::to(Config::get('graham-campbell/core::home', 'pages/home'))
            ->with('success', 'Your page has been deleted successfully.');
    }

    /**
     * Get the user input.
     *
     * @return array
     */
    protected function getInput()
    {
        return array(
            'title'      => $this->binput->get('title'),
            'nav_title'  => $this->binput->get('nav_title'),
            'slug'       => $this->binput->get('slug'),
            'body'       => $this->binput->get('body', null, true, false), // no xss protection please
            'css'        => $this->binput->get('css', null, true, false), // no xss protection please
            'js'         => $this->binput->get('js', null, true, false), // no xss protection please
            'show_title' => ($this->binput->get('show_title') == 'on'),
            'show_nav'   => ($this->binput->get('show_nav') == 'on'),
            'icon'       => $this->binput->get('icon')
        );
    }

    /**
     * Check the page model.
     *
     * @param  mixed   $page
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    protected function checkPage($page, $slug)
    {
        if (!$page) {
            if ($slug == 'home') {
                throw new \Exception('The Homepage Is Missing');
            }

            throw new NotFoundHttpException('Page Not Found');
        }
    }

    /**
     * Check the update input.
     *
     * @param  array   $input
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    protected function checkUpdate(array $input, $slug)
    {
        if ($slug == 'home') {
            if ($slug != $input['slug']) {
                return Redirect::route('pages.edit', array('pages' => $slug))->withInput()
                    ->with('error', 'You cannot change the homepage slug.');
            }

            if ($input['show_nav'] == false) {
                return Redirect::route('pages.edit', array('pages' => $slug))->withInput()
                    ->with('error', 'The homepage must remain on the navigation bar.');
            }
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
     * @return \GrahamCampbell\Binput\Binput
     */
    public function getBinput()
    {
        return $this->binput;
    }

    /**
     * Return the page provider instance.
     *
     * @return \GrahamCampbell\BootstrapCMS\Providers\PageProvider
     */
    public function getPageProvider()
    {
        return $this->pageprovider;
    }
}
