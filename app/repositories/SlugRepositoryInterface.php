<?php

interface SlugRepositoryInterface extends BaseRepositoryInterface{

    public function findBySlug($slug, $columns = array('*'));
}
