<?php namespace GrahamCampbell\BootstrapCMS\Providers;

use GrahamCampbell\BootstrapCMS\Models\Post;

class PostProvider implements Interfaces\IBaseProvider {

    // temp function that works
    public function index() {
        return Post::orderBy('id', 'desc')->get(array('id', 'title', 'summary', 'body'));
    }

    public function findById($id, array $columns = array('*')) {
        return Post::find($id, $columns);
    }

    public function create(array $input) {
        return Post::create($input);
    }
}
