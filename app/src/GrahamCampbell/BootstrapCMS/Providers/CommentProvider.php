<?php namespace GrahamCampbell\BootstrapCMS\Providers;

use GrahamCampbell\BootstrapCMS\Models\Comment;

class CommentProvider implements Interfaces\IBaseProvider {

    public function findById($id, array $columns = array('*')) {
        return Comment::find($id, $columns);
    }

    public function create(array $input) {
        return Comment::create($input);
    }
}
