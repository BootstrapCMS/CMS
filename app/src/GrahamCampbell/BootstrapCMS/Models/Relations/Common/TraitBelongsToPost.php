<?php namespace GrahamCampbell\BootstrapCMS\Models\Relations\Common;

trait TraitBelongsToPost {

    public function post() {
        return $this->belongsTo('GrahamCampbell\BootstrapCMS\Models\Post');
    }

    public function getPost($columns = array('*')) {
        return $this->post()->first($columns);
    }

    public function getPostId() {
        return $this->post_id;
    }
}
