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

use Config;
use Lang;
use Redirect;
use Session;

use Carbon\Carbon;
use Kmd\Logviewer\Logviewer;
use Illuminate\Pagination\Environment;

use GrahamCampbell\CMSCore\Controllers\BaseController;

class LogController extends BaseController {

    /**
     * Constructor (setup access permissions).
     *
     * @return void
     */
    public function __construct() {
        $this->setPermissions(array(
            'getMain' => 'admin',
        ));

        parent::__construct();
    }

    public function getMain() {
        $sapi = php_sapi_name();

        if (preg_match('/apache.*/', $sapi)) {
            $sapi = 'apache';
        }

        $today = Carbon::today()->format('Y-m-d');

        $dirs = Config::get('logviewer::log_dirs');
        reset($dirs);

        $path = key($dirs);

        if (Session::has('success') || Session::has('error')) {
            Session::reflash();
        }

        return Redirect::to(Config::get('logviewer::base_url') . '/' . $path . '/' . $sapi . '/' . $today . '/all');
    }

    public function getDelete($path, $sapi, $date) {
        $logviewer = new Logviewer($path, $sapi, $date);

        if ($logviewer->delete()) {
            $today = Carbon::today()->format('Y-m-d');
            return Redirect::to(Config::get('logviewer::base_url') . '/' . $path . '/' . $sapi . '/' . $today .'/all')->with('success', Lang::get('logviewer::logviewer.delete.success'));
        } else {
            return Redirect::to(Config::get('logviewer::base_url') . '/' . $path . '/' . $sapi . '/' . $date . '/all')->with('error', Lang::get('logviewer::logviewer.delete.error'));
        }
    }

    public function getShow($path, $sapi, $date, $level = null) {
        if (is_null($level) || !is_string($level)) {
            $level = 'all';
        }

        $logviewer = new Logviewer($path, $sapi, $date, $level);

        $log = $logviewer->log();

        $levels = $logviewer->getLevels();

        $paginator = new Environment(App::make('request'), App::make('view'), App::make('translator'));

        $view = Config::get('logviewer::p_view');

        if (is_null($view) || ! is_string($view)) {
            $view = Config::get('view.pagination');
        }

        $paginator->setViewName($view);

        $per_page = Config::get('logviewer::per_page');

        if (is_null($per_page) || !is_int($per_page)) {
            $per_page = 10;
        }

        $page = $paginator->make($log, count($log), $per_page);

        $data = array(
            'paginator'  => $page,
            'log'        => (count($log) > $page->getPerPage() ? array_slice($log, $page->getFrom()-1, $page->getPerPage()) : $log),
            'empty'      => $logviewer->isEmpty(),
            'date'       => $date,
            'sapi'       => Lang::get('logviewer::logviewer.sapi.' . $sapi),
            'sapi_plain' => $sapi,
            'url'        => Config::get('logviewer::base_url'),
            'levels'     => $levels,
            'path'       => $path
        );

        return $this->viewMake(Config::get('logviewer::view'), $data);
    }
}
