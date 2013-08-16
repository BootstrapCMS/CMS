<?php namespace GrahamCampbell\BootstrapCMS\Providers;

use Config;

use GrahamCampbell\BootstrapCMS\Models\Page;

class PageProvider {

    public function all() {
        if ('cache')
        return Page::get(array('id', 'user_id', 'created_at', 'updated_at', 'slug', 'title', 'icon'))->toArray();
    }
}
