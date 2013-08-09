<?php

trait TraitHasManyPages {

    public function pages() {
        return $this->hasMany('Page');
    }

    public function getPages($columns = array('*')) {
        return $this->pages()->get($columns);
    }

    public function findPage($id, $columns = array('*')) {
        return $this->pages()->find($id, $columns);
    }

    public function findPageBySlug($slug, $columns = array('*')) {
        return $this->pages()->where('slug', '=', $slug)->first($columns);
    }
}
