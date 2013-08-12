<?php

interface ISlugModel {

    public function getSlug();

    public function findBySlug($slug, $columns);

}
