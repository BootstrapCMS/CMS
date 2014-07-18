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

namespace GrahamCampbell\BootstrapCMS\Navigation;

use GrahamCampbell\Navigation\Navigation;
use GrahamCampbell\Credentials\Credentials;
use McCool\LaravelAutoPresenter\PresenterDecorator;

/**
 * This is the navigation factory class.
 *
 * @package    Bootstrap-CMS
 * @author     Graham Campbell
 * @copyright  Copyright (C) 2013-2014  Graham Campbell
 * @license    https://github.com/GrahamCampbell/Bootstrap-CMS/blob/master/LICENSE.md
 * @link       https://github.com/GrahamCampbell/Bootstrap-CMS
 */
class Factory
{
    /**
     * The credentials instance.
     *
     * @var \GrahamCampbell\Credentials\Credentials
     */
    protected $credentials;

    /**
     * The navigation instance.
     *
     * @var \GrahamCampbell\Navigation\Navigation
     */
    protected $navigation;

    /**
     * The decorator instance.
     *
     * @var \McCool\LaravelAutoPresenter\PresenterDecorator
     */
    protected $decorator;

    /**
     * The platform name.
     *
     * @var string
     */
    protected $name;

    /**
     * The user property.
     *
     * @var string
     */
    protected $property;

    /**
     * The inverse navigation.
     *
     * @var bool
     */
    protected $inverse;

   /**
     * Create a new instance.
     *
     * @param  \GrahamCampbell\Credentials\Credentials  $credentials
     * @param  \GrahamCampbell\Navigation\Navigation  $navigation
     * @param  \McCool\LaravelAutoPresenter\PresenterDecorator  $decorator
     * @param  string  $name
     * @param  string  $property
     * @param  bool  $inverse
     * @return void
     */
    public function __construct(Credentials $credentials, Navigation $navigation, PresenterDecorator $decorator, $name, $property, $inverse)
    {
        $this->credentials = $credentials;
        $this->navigation = $navigation;
        $this->decorator = $decorator;
        $this->name = $name;
        $this->property = $property;
        $this->inverse = $inverse;
    }

    /**
     * Create a navigation bar.
     *
     * @param  string  $type
     * @return string
     */
    public function make($type = 'default')
    {
        if ($this->credentials->check()) {
            if ($type === 'admin') {
                if ($this->credentials->hasAccess('admin')) {
                    // the requested type is admin, and the user is an admin
                    return $this->navigation->getHTML('admin', 'admin', array(
                        'title' => 'Admin Panel',
                        'side' => $this->getSide(),
                        'inverse' => $this->inverse
                    ));
                } else {
                    // the requested type is admin, and the user is NOT an admin
                    return $this->navigation->getHTML('default', 'default', array(
                        'title' => $this->name,
                        'side' => $this->getSide(),
                        'inverse' => $this->inverse
                    ));
                }
            } else {
                // the requested type is default, and the user is logged in
                return $this->navigation->getHTML('default','default', array(
                    'title' => $this->name,
                    'side' => $this->getSide(),
                    'inverse' => $this->inverse
                ));
            }
        } else {
            // the requested type is default, and the user is NOT logged in
            return $this->navigation->getHTML('default', false, array(
                'title' => $this->name,
                'inverse' => $this->inverse
            ));
        }
    }

    /**
     * Get the relevant user property for the side bar.
     *
     * @return string
     */
    protected function getSide()
    {
        $propery = $this->property;
        $user = $this->getUser();

        return $user->$propery;
    }

    /**
     * Get a decorated user object.
     *
     * @return \GrahamCampbell\BootstrapCMS\Presenters\UserPresenter
     */
    protected function getUser()
    {
        $user = $this->credentials->getUser();

        return $this->decorator->decorate($user);
    }

    /**
     * Return the credentials instance.
     *
     * @return \GrahamCampbell\Credentials\Credentials
     */
    public function getCredentials()
    {
        return $this->credentials;
    }

    /**
     * Return the navigation instance.
     *
     * @return \GrahamCampbell\Navigation\Navigation
     */
    public function getNavigation()
    {
        return $this->navigation;
    }

    /**
     * Return the decorator instance.
     *
     * @return \McCool\LaravelAutoPresenter\PresenterDecorator
     */
    public function getDecorator()
    {
        return $this->decorator;
    }
}
