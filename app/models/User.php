<?php

class User extends Cartalyst\Sentry\Users\Eloquent\User implements IHasManyPages, IHasManyPosts, IHasManyEvents, IHasManyComments {

    use TraitBaseModel, TraitHasManyPages, TraitHasManyPosts, TraitHasManyEvents, TraitHasManyComments;

    protected $table = 'users';

    public function getFirstName() {
        return $this->first_name;
    }

    public function getLastName() {
        return $this->last_name;
    }

    public function getName() {
        return $this->first_name.' '.$this->last_name;
    }

    public function getEmail() {
        return $this->email;
    }

    public function delete() {
        $this->deletePages();
        $this->deletePosts();
        //$this->deleteEvents();
        $this->deleteComments();

        return parent::delete();
    }
}
