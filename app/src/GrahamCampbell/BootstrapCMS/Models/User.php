<?php namespace GrahamCampbell\BootstrapCMS\Models;

use Cartalyst\Sentry\Users\Eloquent\User as SentryUser;

class User extends SentryUser implements Interfaces\IBaseModel, Interfaces\INameModel, Relations\Interfaces\IHasManyPages, Relations\Interfaces\IHasManyPosts, Relations\Interfaces\IHasManyEvents, Relations\Interfaces\IHasManyComments {

    use Common\TraitBaseModel, Common\TraitNameModel, Relations\Common\TraitHasManyPages, Relations\Common\TraitHasManyPosts, Relations\Common\TraitHasManyEvents, Relations\Common\TraitHasManyComments;

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
