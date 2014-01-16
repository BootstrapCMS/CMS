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

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use GrahamCampbell\Binput\Facades\Binput;
use GrahamCampbell\Viewer\Facades\Viewer;
use GrahamCampbell\CMSCore\Models\Folder;
use GrahamCampbell\CMSCore\Facades\FolderProvider;
use GrahamCampbell\CMSCore\Controllers\AbstractController;

/**
 * This is the folder controller class.
 *
 * @package    Bootstrap-CMS
 * @author     Graham Campbell
 * @copyright  Copyright (C) 2013-2014  Graham Campbell
 * @license    https://github.com/GrahamCampbell/Bootstrap-CMS/blob/master/LICENSE.md
 * @link       https://github.com/GrahamCampbell/Bootstrap-CMS
 */
class FolderController extends AbstractController
{
    /**
     * Constructor (setup access permissions).
     *
     * @return void
     */
    public function __construct()
    {
        $this->setPermissions(array(
            'index' => 'user',
        ));

        parent::__construct();
    }

    /**
     * Display the index page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Viewer::make('folders.index');
    }

    /**
     * Show the form for creating a new folder.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Viewer::make('folders.create');
    }

    /**
     * Store a new folder.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $input = array(
            'title'   => Binput::get('title'),
            'summary' => Binput::get('summary'),
            'user_id' => $this->getUserId()
        );

        $rules = Folder::$rules;

        $val = Validator::make($input, $rules);
        if ($val->fails()) {
            return Redirect::route('folders.create')->withInput()->withErrors($val->errors());
        }

        $folder = FolderProvider::create($input);

        // write flash message and redirect
        Session::flash('success', 'Your folder has been created successfully.');
        return Redirect::route('files.index', array('folders' => $folder->getId()));
    }

    /**
     * Show the form for editing the specified folder.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $folder = Folder::find($id);
        $this->checkFolder($folder);

        return Viewer::make('folders.edit', array('folder' => $folder));
    }

    /**
     * Update an existing folder.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $input = array(
            'title'   => Binput::get('title'),
            'summary' => Binput::get('summary')
        );

        $rules = Folder::$rules;
        unset($rules['user_id']);

        $val = Validator::make($input, $rules);
        if ($val->fails()) {
            return Redirect::route('folders.edit')->withInput()->withErrors($val->errors());
        }

        $folder = FolderProvider::find($id);
        $this->checkFolder($folder);

        $folder->update($input);

        // write flash message and redirect
        Session::flash('success', 'Your folder has been updated successfully.');
        return Redirect::route('files.index', array('folders' => $folder->getId()));
    }

    /**
     * Delete an existing folder.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $folder = FolderProvider::find($id);
        $this->checkFolder($folder);

        $folder->delete();

        // write flash message and redirect
        Session::flash('success', 'Your folder has been deleted successfully.');
        return Redirect::route('folders.index');
    }

    /**
     * Check the folder model.
     *
     * @param  mixed  $folder
     * @return void
     */
    protected function checkFolder($folder)
    {
        if (!$folder) {
            return App::abort(404, 'Folder Not Found');
        }
    }
}
