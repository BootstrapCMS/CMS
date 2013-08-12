<?php

interface IHasManyPosts {

    public function posts();

    public function getPosts($columns = array('*'));

    public function findPost($id, $columns = array('*'));

    public function deletePosts();

}
