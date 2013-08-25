<?php namespace GrahamCampbell\BootstrapCMS\Models\Relations\Interfaces;

interface IHasManyPosts {

    /**
     * Get the post relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOneOrMany
     */
    public function posts();

    /**
     * Get the post collection.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getPosts();

    /**
     * Get the specified post.
     *
     * @return \GrahamCampbell\BootstrapCMS\Models\Post
     */
    public function findPost($id, $columns = array('*'));

    /**
     * Delete all posts.
     *
     * @return void
     */
    public function deletePosts();

}
