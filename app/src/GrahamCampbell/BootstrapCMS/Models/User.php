<?php namespace GrahamCampbell\BootstrapCMS\Models;

use Event as LaravelEvent;

use Cartalyst\Sentry\Users\Eloquent\User as SentryUser;

class User extends SentryUser implements Interfaces\IBaseModel, Interfaces\INameModel, Relations\Interfaces\IHasManyPages, Relations\Interfaces\IHasManyPosts, Relations\Interfaces\IHasManyEvents, Relations\Interfaces\IHasManyComments {

    use Common\TraitBaseModel, Common\TraitNameModel, Relations\Common\TraitHasManyPages, Relations\Common\TraitHasManyPosts, Relations\Common\TraitHasManyEvents, Relations\Common\TraitHasManyComments;

    /**
     * The table the users are stored in.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The columns to select when displaying an index.
     *
     * @var array
     */
    public static $index = array('id', 'email', 'first_name', 'last_name');

    /**
     * The max users per page when displaying a paginated index.
     *
     * @var int
     */
    public static $paginate = 20;

    /**
     * The columns to order by when displaying an index.
     *
     * @var string
     */
    public static $order = 'email';

    /**
     * The direction to order by when displaying an index.
     *
     * @var string
     */
    public static $sort = 'asc';

    /**
     * Get email.
     *
     * @param  array  $input
     * @return void
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Create a new user.
     *
     * @param  array  $input
     * @return \GrahamCampbell\BootstrapCMS\Models\User
     */
    public static function create(array $input) {
        $return = parent::create($input);
        LaravelEvent::fire('user.created');
        return $return;
    }

    /**
     * Update an existing user.
     *
     * @param  array  $input
     * @return \GrahamCampbell\BootstrapCMS\Models\User
     */
    public function update(array $input = array()) {
        $return = parent::update($input);
        LaravelEvent::fire('user.updated');
        return $return;
    }

    /**
     * Delete an existing user.
     *
     * @param  array  $input
     * @return void
     */
    public function delete() {
        $this->deletePages();
        $this->deletePosts();
        $this->deleteEvents();
        $this->deleteComments();
        $return = parent::delete();
        LaravelEvent::fire('user.deleted');
        return $return;
    }
}
