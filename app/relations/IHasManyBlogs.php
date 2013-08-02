<?php

interface IHasManyBlogs {

    public function blogs();

    public function getBlogs($columns = array('*'));

    public function findBlog($id, $columns = array('*'));

    public function findBlogBySlug($slug, $columns = array('*'));

}
