<?php

/*
 * This file is part of Bootstrap CMS.
 *
 * (c) Graham Campbell <graham@alt-three.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\BootstrapCMS\Repositories;

use GrahamCampbell\Credentials\Repositories\AbstractRepository;
use GrahamCampbell\Credentials\Repositories\PaginateRepositoryTrait;
use GrahamCampbell\Credentials\Repositories\SlugRepositoryTrait;
use Illuminate\Support\Facades\Cache;

/**
 * This is the page repository class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class PageRepository extends AbstractRepository
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
        return is_array($value) && !empty($value);
    }
}
