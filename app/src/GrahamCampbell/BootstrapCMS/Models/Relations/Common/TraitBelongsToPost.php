<?php namespace GrahamCampbell\BootstrapCMS\Models\Relations\Common;

trait TraitBelongsToPost {

    /**
     * Get the post relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post() {
        return $this->belongsTo('GrahamCampbell\BootstrapCMS\Models\Post');
    }

    /**
     * Get the post model.
     *
     * @return \GrahamCampbell\BootstrapCMS\Models\Post
     */
    public function getPost($columns = array('*')) {
        return $this->post()->first($columns);
    }

    /**
     * Get the post id.
     *
     * @return int
     */
    public function getPostId() {
        return $this->post_id;
    }
}
