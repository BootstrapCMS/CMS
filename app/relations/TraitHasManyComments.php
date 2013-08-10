<?php

trait TraitHasManyComments {

    public function comments() {
        return $this->hasMany('Comment');
    }

    public function getComments($columns = array('*')) {
        return $this->comments()->get($columns);
    }

    public function getCommentsReversed($columns = array('*')) {
        return $this->comments()->orderBy('id', 'desc')->get($columns);
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
