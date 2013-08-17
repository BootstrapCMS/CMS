<?php namespace GrahamCampbell\BootstrapCMS\Providers;

// use Config;

use GrahamCampbell\BootstrapCMS\Models\Page;

class PageProvider implements Interfaces\IBaseProvider, Interfaces\ISlugProvider {

    // public function all() {
    //     if ('cache')
    //     return Page::get(array('id', 'user_id', 'created_at', 'updated_at', 'slug', 'title', 'icon'))->toArray();
    // }

    public function findById($id, array $columns = array('*')) {
        return Page::find($id, $columns);
    }

    public function findBySlug($slug, array $columns = array('*')) {
        return Page::where('slug', '=', $slug)->first($columns);
    }

    public function create(array $input) {
        return Page::create($input);
    }
}
