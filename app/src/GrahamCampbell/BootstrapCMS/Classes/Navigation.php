<?php namespace GrahamCampbell\BootstrapCMS\Classes;

use Cache;
use Config;
use Request;

use GrahamCampbell\BootstrapCMS\Models\Page;

class Navigation {

    public function get() {
        $raw = $this->goGet();

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

    protected function goGet() {
        // if caching is enabled
        if (Config::get('cms.cache') === true) {
            // check if the cache needs regenerating
            if ($this->validCache()) {
                // if not, then pull from the cache
                $value = $this->getCache();
            } else {
                // if regeneration is needed, do the work
                $value = $this->sendGet();
                // add the value from the work to the cache
                $this->setCache($value);
            }
        } else {
            // do the work because caching is disabled
            $value = $this->sendGet();
        }

        // spit out the value
        return $value;
    }

    protected function sendGet() {
        // do the work needed to generate the nav bar
        return Page::where('show_nav', '=', true)->get(array('title', 'slug', 'icon'))->toArray();
    }

    protected function getCache() {
        // pull from nav bar from the cache
        return json_decode(Cache::get('nav'), true);
    }

    protected function setCache($array) {
        // cache the nav bar until another event resets it
        return Cache::forever('nav', json_encode($array));
    }

    protected function purgeCache() {
        // actually purge the nav bar cache
        return Cache::forget('nav');
    }

    protected function validCache($name = 'main') {
        // check if the cache needs regenerating
        return Cache::has('nav');
    }

    public function purge() {
        // call the purge cache method
        return $this->purgeCache();
    }

    public function refresh() {
        // update the nav bar cache
        return $this->setCache($this->sendGet());
    }
}
