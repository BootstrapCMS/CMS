<?php namespace GrahamCampbell\BootstrapCMS\Classes;

use Cache;
use Config;
use Request;

use GrahamCampbell\BootstrapCMS\Models\Page;

class Navigation {

    /**
     * Get the processed nav var by name.
     *
     * @param  string  $name
     * @return array
     */
    public function get($name = 'main') {
        switch ($name) {
            case 'main':
                $nav = $this->getMain();
                break;
            case 'bar':
                $nav = $this->getBar();
                break;
            case 'admin':
                $nav = $this->getAdmin();
                break;
            default:
                throw new \InvalidArgumentException($name.' is not a valid item');
        }

        // check if each item is active
        foreach ($nav as $key => $value) {
            // if the request starts with the slug
            if (Request::is($value['slug']) || Request::is($value['slug'].'/*')) {
                // then the navigation item is active, or selected
                $nav[$key]['active'] = true;
            } else {
                // then the navigation item is not active or selected
                $nav[$key]['active'] = false;
            }
        }

        // spit out the nav bar array at the end
        return $nav;
    }

    /**
     * Get the processed main nav var.
     *
     * @return array
     */
    protected function getMain() {
        $raw = $this->goGet('main');

        // separate the first page
        $value = $raw[0];
        unset($raw[0]);
        // the page slug is preppended by 'pages/'
        $value['slug'] = 'pages/'.$value['slug'];
        // make sure it is at the very start of the nav bar
        $nav[] = $value;

        // add the blog page after the fist page if blogging is enabled
        if (Config::get('cms.blogging')) {
            $nav[] = array('title' => 'Blog', 'slug' => 'blog/posts', 'icon' => 'icon-book');
        }

        // add the events page after the fist page if events are enabled
        if (Config::get('cms.events')) {
            $nav[] = array('title' => 'Events', 'slug' => 'events', 'icon' => 'icon-calendar');
        }

        // add the remaining pages to the nav bar
        foreach ($raw as $key => $value) {
            // each page slug is preppended by 'pages/'
            $value['slug'] = 'pages/'.$raw[$key]['slug'];
            $nav[] = $value;
        }

        // spit out the nav bar array at the end
        return $nav;
    }

    /**
     * Get the processed bar nav var.
     *
     * @return array
     */
    protected function getBar() {
        return array(); // TODO
    }

    /**
     * Get the processed admin nav var.
     *
     * @return array
     */
    protected function getAdmin() {
        // set the admin home route
        $nav = goGet('admin');

        // spit out the nav bar array at the end
        return $nav;
    }

    /**
     * Get the raw nav var by name.
     *
     * @param  string  $name
     * @return array
     */
    protected function goGet($name) {
        // if caching is enabled
        if (Config::get('cms.cache') === true) {
            // check if the cache needs regenerating
            if ($this->validCache($name)) {
                // if not, then pull from the cache
                $value = $this->getCache($name);
                // check if the value is valid
                if ($this->validValue($value)) {
                    // if is invalid, do the work
                    $value = $this->sendGet($name);
                    // add the value from the work to the cache
                    $this->setCache($name, $value);
                }
            } else {
                // if regeneration is needed, do the work
                $value = $this->sendGet($name);
                // add the value from the work to the cache
                $this->setCache($name, $value);
            }
        } else {
            // do the work because caching is disabled
            $value = $this->sendGet($name);
        }

        // spit out the value
        return $value;
    }

    /**
     * Get the raw nav var by name by working.
     *
     * @param  string  $name
     * @return array
     */
    protected function sendGet($name) {
        switch ($name) {
            case 'main':
                return $this->sendGetMain();
            case 'bar':
                return $this->sendGetBar();
            case 'admin':
                return $this->sendGetAdmin();
            default:
                throw new \InvalidArgumentException($name.' is not a valid item');
        }
    }

    /**
     * Get the raw main nav var by working.
     *
     * @return array
     */
    protected function sendGetMain() {
        return Page::where('show_nav', '=', true)->get(array('title', 'slug', 'icon'))->toArray();
    }

    /**
     * Get the raw bar nav var by working.
     *
     * @return array
     */
    protected function sendGetBar() {
        // TODO
        return array();
    }

    /**
     * Get the raw admin nav var by working.
     *
     * @return array
     */
    protected function sendGetAdmin() {
        // TODO
        return array(array('title' => 'Admin', 'slug' => 'admin', 'icon' => '', 'active' => false));
    }

    /**
     * Get the raw nav var by name from the cache.
     *
     * @param  string  $name
     * @return array
     */
    protected function getCache($name) {
        return Cache::section('nav')->get($name);
    }

    /**
     * Set the raw nav var by name in the cache.
     *
     * @param  string  $name
     * @param  string  $value
     * @return void
     */
    protected function setCache($name, $value) {
        Cache::section('nav')->forever($name, $value);
    }

    /**
     * Flush all nav vars from the cache.
     *
     * @return void
     */
    protected function flushCache() {
        Cache::section('nav')->flush();
    }

    /**
     * Purge the nav var by name in the cache.
     *
     * @param  string  $name
     * @return void
     */
    protected function purgeCache($name) {
        Cache::section('nav')->forget($name);
    }

    /**
     * Check of the nav var by name is cached and is current.
     *
     * @param  string  $name
     * @return bool
     */
    protected function validCache($name) {
        return Cache::section('nav')->has($name);
    }

    /**
     * Check of the nav var by name is not corrupt.
     *
     * @param  string  $value
     * @return bool
     */
    protected function validValue($value) {
        return (is_null($value) || !is_array($value));
    }

    /**
     * Flush all nav vars from the cache if the cache in enabled.
     *
     * @return void
     */
    public function flush() {
        if (Config::get('cms.cache') === true) {
            $this->flushCache();
        }
    }

    /**
     * Purge the nav var by name in the cache if the cache in enabled.
     *
     * @param  string  $name
     * @return void
     */
    public function purge($name = 'main') {
        if (Config::get('cms.cache') === true) {
            $this->purgeCache($name);
        }
    }

    /**
     * Refresh the raw nav var by name in the cache if the cache in enabled.
     *
     * @param  string  $name
     * @param  string  $value
     * @return void
     */
    public function refresh($name = 'main') {
        if (Config::get('cms.cache') === true) {
            $this->setCache($name, $this->sendGet($name));
        }
    }
}
