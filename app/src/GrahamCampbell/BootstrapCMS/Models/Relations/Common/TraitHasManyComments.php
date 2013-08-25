<?php namespace GrahamCampbell\BootstrapCMS\Models\Relations\Common;

trait TraitHasManyComments {

    /**
     * Get the comment relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOneOrMany
     */
    public function comments() {
        return $this->hasMany('GrahamCampbell\BootstrapCMS\Models\Comment');
    }

    /**
     * Get the comment collection.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getComments() {
        $model = 'GrahamCampbell\BootstrapCMS\Models\Comment';

        if (property_exists($model, 'order')) {
            return $this->comments()->orderBy($model::$order, $model::$sort)->get($model::$index);
        }

        return $this->comments()->get($model::$index);
    }

    /**
     * Get the specified comment.
     *
     * @return \GrahamCampbell\BootstrapCMS\Models\Comment
     */
    public function findComment($id, $columns = array('*')) {
        return $this->comments()->find($id, $columns);
    }

    /**
     * Delete all comments.
     *
     * @return void
     */
    public function deleteComments() {
        foreach($this->getComments(array('id')) as $comment) {
            $comment->delete();
        }
    }
}
