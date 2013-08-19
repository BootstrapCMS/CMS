<?php namespace GrahamCampbell\BootstrapCMS\Models\Relations\Interfaces;

interface IHasManyPosts {

    public function posts();

    public function getPosts();

    public function findPost($id, $columns = array('*'));

    public function deletePosts();

}
