<?php

interface IBelongsToBlog {

    public function blog();

    public function getBlog($columns = array('*'));

    public function getBlogId();

    public function getBlogSlug();

}
