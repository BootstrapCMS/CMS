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

namespace GrahamCampbell\BootstrapCMS\Classes;

use Illuminate\View\Environment;
use GrahamCampbell\Navigation\Classes\Navigation;
use GrahamCampbell\Credentials\Classes\Credentials;
use GrahamCampbell\Viewer\Classes\Viewer as BaseViewer;

/**
 * This is the view class.
 *
 * @package    Bootstrap-CMS
 * @author     Graham Campbell
 * @copyright  Copyright (C) 2013-2014  Graham Campbell
 * @license    https://github.com/GrahamCampbell/Bootstrap-CMS/blob/master/LICENSE.md
 * @link       https://github.com/GrahamCampbell/Bootstrap-CMS
 */
class Viewer extends BaseViewer
{
    /**
     * The credentials instance.
     *
     * @var \GrahamCampbell\Credentials\Classes\Credentials
     */
    protected $credentials;

    /**
     * The navigation instance.
     *
     * @var \GrahamCampbell\Navigation\Classes\Navigation
     */
    protected $navigation;

    /**
     * The platform name.
     *
     * @var string
     */
    protected $name;

    /**
     * The inverse navigation.
     *
     * @var bool
     */
    protected $inverse;

    /**
     * Create a new instance.
     *
     * @param  \Illuminate\View\Environment  $view
     * @param  \GrahamCampbell\Credentials\Classes\Credentials  $credentials
     * @param  \GrahamCampbell\Navigation\Classes\Navigation  $navigation
     * @param  string  $name
     * @param  bool  $inverse
     * @return void
     */
    public function __construct(Environment $view, Credentials $credentials, Navigation $navigation, $name, $inverse)
    {
        parent::__construct($view);

        $this->credentials = $credentials;
        $this->navigation = $navigation;
        $this->name = $name;
        $this->inverse = $inverse;
    }

    /**
     * Get a evaluated view contents for the given view.
     *
     * @param  string  $view
     * @param  array   $data
     * @param  string  $type
     * @return \Illuminate\View\View
     */
    public function make($view, array $data = array(), $type = 'default')
    {
        if ($this->credentials->check()) {
            if ($type === 'admin') {
                if ($this->credentials->hasAccess('admin')) {
                    $data['site_name'] = 'Admin Panel';
                    $data['navigation'] = $this->navigation->getHTML('admin', 'admin', array('title' => $data['site_name'], 'side' => $this->credentials->getUser()->email, 'inverse' => $this->inverse));
                } else {
                    $data['site_name'] = $this->name;
                    $data['navigation'] = $this->navigation->getHTML('default', 'default', array('title' => $data['site_name'], 'side' => $this->credentials->getUser()->email, 'inverse' => $this->inverse));
                }
            } else {
                $data['site_name'] = $this->name;
                $data['navigation'] = $this->navigation->getHTML('default', 'default', array('title' => $data['site_name'], 'side' => $this->credentials->getUser()->email, 'inverse' => $this->inverse));
            }
        } else {
            $data['site_name'] = $this->name;
            $data['navigation'] = $this->navigation->getHTML('default', false, array('title' => $data['site_name'], 'inverse' => $this->inverse));
        }

        return parent::make($view, $data);
    }

    /**
     * Return the credentials instance.
     *
     * @return \GrahamCampbell\Credentials\Classes\Credentials
     */
    public function getCredentials()
    {
        return $this->credentials;
    }

    /**
     * Return the navigation instance.
     *
     * @return \GrahamCampbell\Navigation\Classes\Navigation
     */
    public function getNavigation()
    {
        return $this->navigation;
    }
}
