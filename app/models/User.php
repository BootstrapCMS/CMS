<?php

class User extends Cartalyst\Sentry\Users\Eloquent\User implements IBaseModel, INameModel, IHasManyPages, IHasManyPosts, IHasManyEvents, IHasManyComments {

    use TraitBaseModel, TraitNameModel, TraitHasManyPages, TraitHasManyPosts, TraitHasManyEvents, TraitHasManyComments;

    protected $table = 'users';

    public function getEmail() {
        return $this->email;
    }

    public function delete() {
        $this->deletePages();
        $this->deletePosts();
        $this->deleteEvents();
        $this->deleteComments();

        return parent::delete();
    }
}
