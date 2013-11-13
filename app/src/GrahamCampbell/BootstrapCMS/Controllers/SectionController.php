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
use SectionProvider;
use Session;
use Validator;

use GrahamCampbell\CMSCore\Models\Section;
use GrahamCampbell\CMSCore\Controllers\BaseController;

class SectionController extends BaseController {

    /**
     * Constructor (setup access permissions).
     *
     * @return void
     */
    public function __construct() {
        // $this->setPermissions(array(
        //     'index' => 'admin',
        // ));

        parent::__construct();
    }

    /**
     * Display the index page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return $this->viewMake('sections.index', array());
    }

    /**
     * Show the form for creating a new section.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return $this->viewMake('sections.create');
    }

    /**
     * Store a new section.
     *
     * @return \Illuminate\Http\Response
     */
    public function store() {
        $input = array(
            'title'   => Binput::get('title'),
            'summary' => Binput::get('summary'),
            'user_id' => $this->getUserId()
        );

        $rules = Section::$rules;

        $val = Validator::make($input, $rules);
        if ($val->fails()) {
            return Redirect::route('sections.create')->withInput()->withErrors($val->errors());
        }

        $section = SectionProvider::create($input);

        // write flash message and redirect
        Session::flash('success', 'Your section has been created successfully.');
        return Redirect::route('topics.index', array('sections' => $section->getId()));
    }

    /**
     * Show the form for editing the specified section.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $section = Section::find($id);
        $this->checkSection($section);

        return $this->viewMake('sections.edit', array('section' => $section));
    }

    /**
     * Update an existing section.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id) {
        $input = array(
            'title'   => Binput::get('title'),
            'summary' => Binput::get('summary')
        );

        $rules = Section::$rules;
        unset($rules['user_id']);

        $val = Validator::make($input, $rules);
        if ($val->fails()) {
            return Redirect::route('sections.edit')->withInput()->withErrors($val->errors());
        }

        $section = SectionProvider::find($id);
        $this->checkSection($section);

        $section->update($input);

        // write flash message and redirect
        Session::flash('success', 'Your section has been updated successfully.');
        return Redirect::route('topics.index', array('sections' => $section->getId()));
    }

    /**
     * Delete an existing section.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $section = SectionProvider::find($id);
        $this->checkSection($section);

        $section->delete();

        // write flash message and redirect
        Session::flash('success', 'Your section has been deleted successfully.');
        return Redirect::route('sections.index');
    }

    /**
     * Check the section model.
     *
     * @return mixed
     */
    protected function checkSection($section) {
        if (!$section) {
            return App::abort(404, 'Section Not Found');
        }
    }
}
