<?php namespace GrahamCampbell\BootstrapCMS\Models\Relations\Common;

trait TraitHasManyPosts {

    public function posts() {
        return $this->hasMany('GrahamCampbell\BootstrapCMS\Models\Post');
    }

    public function getPosts() {
        $model = 'GrahamCampbell\BootstrapCMS\Models\Post';

        if (property_exists($model, 'order')) {
            return $this->posts()->orderBy($model::$order, $model::$sort)->get($model::$index);
        }        
        return $this->posts()->get($model::$index);
    }

    public function findPost($id, $columns = array('*')) {
        return $this->posts()->find($id, $columns);
    }

    public function deletePosts() {
        foreach($this->getPosts(array('id')) as $post) {
            $post->delete();
        }
    }
}
