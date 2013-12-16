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

use Binput;
use Redirect;
use FolderProvider;
use Session;
use Validator;

use GrahamCampbell\CMSCore\Models\Folder;
use GrahamCampbell\CMSCore\Controllers\BaseController;

class FolderController extends BaseController {

    /**
     * Constructor (setup access permissions).
     *
     * @return void
     */
    public function __construct() {
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
    public function index() {
        return $this->viewMake('folders.index', array());
    }

    /**
     * Show the form for creating a new folder.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return $this->viewMake('folders.create');
    }

    /**
     * Store a new folder.
     *
     * @return \Illuminate\Http\Response
     */
    public function store() {
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
    public function edit($id) {
        $folder = Folder::find($id);
        $this->checkFolder($folder);

        return $this->viewMake('folders.edit', array('folder' => $folder));
    }

    /**
     * Update an existing folder.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id) {
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
    public function destroy($id) {
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
     * @return mixed
     */
    protected function checkFolder($folder) {
        if (!$folder) {
            return App::abort(404, 'Folder Not Found');
        }
    }
}
