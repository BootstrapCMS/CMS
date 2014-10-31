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

namespace GrahamCampbell\BootstrapCMS\Repositories;

use GrahamCampbell\Database\Repositories\AbstractRepository;
use GrahamCampbell\Database\Repositories\Common\PaginateRepositoryTrait;
use GrahamCampbell\Database\Repositories\Common\SlugRepositoryTrait;
use GrahamCampbell\Database\Repositories\Interfaces\PaginateRepositoryInterface;
use GrahamCampbell\Database\Repositories\Interfaces\SlugRepositoryInterface;
use Illuminate\Support\Facades\Cache;

/**
 * This is the page repository class.
 *
 * @author    Graham Campbell <graham@mineuk.com>
 * @copyright 2013-2014 Graham Campbell
 * @license   <https://github.com/GrahamCampbell/Bootstrap-CMS/blob/master/LICENSE.md> AGPL 3.0
 */
class PageRepository extends AbstractRepository implements PaginateRepositoryInterface, SlugRepositoryInterface
{
    use PaginateRepositoryTrait, SlugRepositoryTrait;

    /**
     * A cache of the page navigation.
     *
     * @var array
     */
    protected $nav = [];

    /**
     * Get the page navigation.
     *
     * @return array
     */
    public function navigation()
    {
        // caching logic
        if ($this->validCache($this->nav)) {
            // get the value from the class cache
            $value = $this->nav;
        } else {
            // pull from the cache
            $value = $this->getCache();
            // check if the value is valid
            if (!$this->validCache($value)) {
                // if is invalid, do the work
                $value = $this->sendGet();
                // add the value from the work to the cache
                $this->setCache($value);
            }
        }

        // cache the value in the class
        $this->nav = $value;

        // spit out the value
        return $value;
    }

    /**
     * Flush the page navigation from the cache.
     *
     * @return $this
     */
    public function flush()
    {
        Cache::forget('navigation');

        return $this;
    }

    /**
     * Refresh the page navigation cache.
     *
     * @return $this
     */
    public function refresh()
    {
        return $this->setCache($this->sendGet());
    }

    /**
     * Get the page navigation by working.
     *
     * @return array
     */
    protected function sendGet()
    {
        $model = $this->model;
        $pages = $model::where('show_nav', '=', true)->get(['nav_title', 'slug', 'icon'])->toArray();

        foreach ($pages as $key => $page) {
            $pages[$key]['slug'] = 'pages/'.$page['slug'];
            $pages[$key]['title'] = $page['nav_title'];
            unset($pages[$key]['nav_title']);
        }

        return $pages;
    }

    /**
     * Get the page navigation from the cache.
     *
     * @return array
     */
    protected function getCache()
    {
        return Cache::get('navigation');
    }

    /**
     * Set the page navigation in the cache.
     *
     * @param array $value
     *
     * @return $this
     */
    protected function setCache($value)
    {
        Cache::forever('navigation', $value);

        return $this;
    }

    /**
     * Check of the nav var is not corrupt.
     *
     * @param array $value
     *
     * @return bool
     */
    protected function validCache($value)
    {
        return (is_array($value) && !empty($value));
    }
}
