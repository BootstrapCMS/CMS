<?php namespace GrahamCampbell\BootstrapCMS\Models;

use Cartalyst\Sentry\Users\Eloquent\User as SentryUser;

class User extends SentryUser implements Interfaces\IBaseModel, Interfaces\INameModel, Relations\Interfaces\IHasManyPages, Relations\Interfaces\IHasManyPosts, Relations\Interfaces\IHasManyEvents, Relations\Interfaces\IHasManyComments {

    use Common\TraitBaseModel, Common\TraitNameModel, Relations\Common\TraitHasManyPages, Relations\Common\TraitHasManyPosts, Relations\Common\TraitHasManyEvents, Relations\Common\TraitHasManyComments;

    protected $table = 'users';

    public function getEmail() {
        return $this->email;
    }

    public static function create(array $input) {
        $return = parent::create($input);
        \Event::fire('user.created');
        return $return;
    }

    public function update(array $input = array()) {
        $return = parent::update($input);
        \Event::fire('user.updated');
        return $return;
    }

    public function delete() {
        $this->deletePages();
        $this->deletePosts();
        $this->deleteEvents();
        $this->deleteComments();
        $return = parent::delete();
        \Event::fire('user.deleted');
        return $return;
    }
}
