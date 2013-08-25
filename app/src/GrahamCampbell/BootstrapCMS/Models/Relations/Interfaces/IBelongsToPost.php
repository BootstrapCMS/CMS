<?php namespace GrahamCampbell\BootstrapCMS\Models\Relations\Interfaces;

interface IBelongsToPost {

    /**
     * Get the post relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post();

    /**
     * Get the post model.
     *
     * @return \GrahamCampbell\BootstrapCMS\Models\Post
     */
    public function getPost($columns = array('*'));

    /**
     * Get the post id.
     *
     * @return int
     */
    public function getPostId();

}
