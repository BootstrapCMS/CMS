<?php namespace GrahamCampbell\BootstrapCMS\Models\Relations\Common;

trait TraitHasManyComments {

    public function comments() {
        return $this->hasMany('GrahamCampbell\BootstrapCMS\Models\Comment');
    }

    public function getComments() {
        $model = 'GrahamCampbell\BootstrapCMS\Models\Comment';

        if (property_exists($model, 'order')) {
            return $this->comments()->orderBy($model::$order, $model::$sort)->get($model::$index);
        }

        return $this->comments()->get($model::$index);
    }

    public function findComment($id, $columns = array('*')) {
        return $this->comments()->find($id, $columns);
    }

    public function deleteComments() {
        foreach($this->getComments(array('id')) as $comment) {
            $comment->delete();
        }
    }
}
