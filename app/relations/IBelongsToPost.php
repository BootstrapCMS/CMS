<?php

interface IBelongsToPost {

    public function post();

    public function getPost($columns = array('*'));

    public function getPostId();

}
