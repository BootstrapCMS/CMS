<?php

trait TraitBelongsToPost {

    public function post() {
        return $this->belongsTo('Post');
    }

    public function getPost($columns = array('*')) {
        return $this->post()->first($columns);
    }

    public function getPostId() {
        return $this->post_id;
    }
}
