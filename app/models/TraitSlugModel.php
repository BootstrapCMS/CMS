<?php

trait TraitSlugModel {

    public function getSlug() {
        return $this->slug;
    }

    public function findBySlug($slug, $columns = array('*')) {
        return $this->where('slug', '=', $slug)->first($columns);
    }
}
