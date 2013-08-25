<?php namespace GrahamCampbell\BootstrapCMS\Models\Relations\Common;

trait TraitHasManyPosts {

    /**
     * Get the post relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOneOrMany
     */
    public function posts() {
        return $this->hasMany('GrahamCampbell\BootstrapCMS\Models\Post');
    }

    /**
     * Get the post collection.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getPosts() {
        $model = 'GrahamCampbell\BootstrapCMS\Models\Post';

        if (property_exists($model, 'order')) {
            return $this->posts()->orderBy($model::$order, $model::$sort)->get($model::$index);
        }        
        return $this->posts()->get($model::$index);
    }

    /**
     * Get the specified post.
     *
     * @return \GrahamCampbell\BootstrapCMS\Models\Post
     */
    public function findPost($id, $columns = array('*')) {
        return $this->posts()->find($id, $columns);
    }

    /**
     * Delete all posts.
     *
     * @return void
     */
    public function deletePosts() {
        foreach($this->getPosts(array('id')) as $post) {
            $post->delete();
        }
    }
}
