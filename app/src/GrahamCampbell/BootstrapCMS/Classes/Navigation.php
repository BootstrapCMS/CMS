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
        // set its slug as a page
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
            $value['slug'] = 'pages/'.$raw[$key]['slug'];
            $nav[] = $value;
        }
        
        // check if each item is active
        foreach ($nav as $key => $value) {
            if (Request::is($value['slug']) || Request::is($value['slug'].'/*')) {
                $nav[$key]['active'] = true;
            } else {
                $nav[$key]['active'] = false;
            }
        }

        // spit out the nav bar array at the end
        return $nav;
    }

    protected function goGet() {
        if (Config::get('cms.cache') === true) {
            if ($this->validCache()) {
                $value = $this->getCache();
            } else {
                $value = $this->sendGet();
                $this->setCache($value);
            }
        } else {
            $value = $this->sendGet();
        }

        return $value;
    }

    protected function sendGet() {
        return Page::where('show_nav', '=', true)->get(array('title', 'slug', 'icon'))->toArray();
    }

    protected function getCache() {
        return json_decode(Cache::get('nav'), true);
    }

    protected function setCache($array) {
        return Cache::forever('nav', json_encode($array));
    }

    protected function purgeCache() {
        return Cache::forget('nav');
    }

    protected function validCache($name = 'main') {
        return Cache::has('nav');
    }

    public function purge() {
        return $this->purgeCache();
    }

    public function refresh() {
        return $this->setCache($this->sendGet());
    }
}
