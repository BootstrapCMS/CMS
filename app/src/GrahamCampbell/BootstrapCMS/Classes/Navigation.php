<?php namespace GrahamCampbell\BootstrapCMS\Classes;

use Cache;
use Config;
use Request;

use GrahamCampbell\BootstrapCMS\Models\Page;

class Navigation implements \GrahamCampbell\BootstrapCMS\Interfaces\ICacheable {

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

    protected function getBar() {
        return array(); // TODO
    }

    protected function getAdmin() {
        // set the admin home route
        $nav = goGet('admin');

        // spit out the nav bar array at the end
        return $nav;
    }

    protected function goGet($name) {
        // if caching is enabled
        if (Config::get('cms.cache') === true) {
            // check if the cache needs regenerating
            if ($this->validCache($name)) {
                // if not, then pull from the cache
                $value = $this->getCache($name);
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

    protected function sendGetMain() {
        // do the work needed to generate the nav bar
        return Page::where('show_nav', '=', true)->get(array('title', 'slug', 'icon'))->toArray();
    }

    protected function sendGetBar() {
        // TODO
        return array();
    }

    protected function sendGetAdmin() {
        // TODO
        return array(array('title' => 'Admin', 'slug' => 'admin', 'icon' => '', 'active' => false));
    }

    protected function getCache($name) {
        // pull from nav bar from the cache
        return json_decode(Cache::section('nav')->get($name), true);
    }

    protected function setCache($name, $value) {
        // cache the nav bar until another event resets it
        return Cache::section('nav')->forever($name, json_encode($value));
    }

    protected function flushCache() {
        // actually purge the entire section
        return Cache::section('nav')->flush();
    }

    protected function purgeCache($name) {
        // actually purge the nav bar cache
        return Cache::section('nav')->forget($name);
    }

    protected function validCache($name) {
        // check if the cache needs regenerating
        return Cache::section('nav')->has($name);
    }

    public function flush() {
        return $this->flushCache();
    }

    public function purge($name = 'main') {
        // call the purge cache method
        return $this->purgeCache($name);
    }

    public function refresh($name = 'main') {
        // update the nav bar cache
        return $this->setCache($this->sendGet($name));
    }
}
