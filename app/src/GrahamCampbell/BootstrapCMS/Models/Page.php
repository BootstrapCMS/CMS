<?php namespace GrahamCampbell\BootstrapCMS\Models;

use Event as LaravelEvent;

class Page extends BaseModel implements Interfaces\ITitleModel, Interfaces\ISlugModel, Interfaces\IBodyModel, Relations\Interfaces\IBelongsToUser {

    use Common\TraitTitleModel, Common\TraitSlugModel, Common\TraitBodyModel, Relations\Common\TraitBelongsToUser;

    /**
     * The table the pages are stored in.
     *
     * @var string
     */
    protected $table = 'pages';

    /**
     * The columns to select when displaying an index.
     *
     * @var array
     */
    public static $index = array('id', 'slug', 'title');

    /**
     * The max pages per page when displaying a paginated index.
     *
     * @var int
     */
    public static $paginate = 10;

    /**
     * The columns to order by when displaying an index.
     *
     * @var string
     */
    public static $order = 'slug';

    /**
     * The direction to order by when displaying an index.
     *
     * @var string
     */
    public static $sort = 'asc';

    /**
     * The page validation rules.
     *
     * @var array
     */
    public static $rules = array(
        'title'      => 'required',
        'slug'       => 'required',
        'body'       => 'required',
        'show_title' => 'required',
        'show_nav'   => 'required',
        'user_id'    => 'required',
    );

    /**
     * The page factory.
     *
     * @var array
     */
    public static $factory = array(
        'id'         => 1,
        'title'      => 'Page Title',
        'slug'       => 'page-title',
        'body'       => 'This is the page body!',
        'show_title' => true,
        'show_nav'   => true,
        'icon'       => '',
        'user_id'    => 1,
    );

    /**
     * Get show_title.
     *
     * @return int
     */
    public function getShowTitle() {
        return $this->show_title;
    }

    /**
     * Get show_nav.
     *
     * @return int
     */
    public function getShowNav() {
        return $this->show_nav;
    }

    /**
     * Get icon.
     *
     * @return string
     */
    public function getIcon() {
        return $this->icon;
    }

    /**
     * Create a new page.
     *
     * @param  array  $input
     * @return \GrahamCampbell\BootstrapCMS\Models\Page
     */
    public static function create(array $input) {
        $return = parent::create($input);
        LaravelEvent::fire('page.created');
        return $return;
    }

    /**
     * Update an existing page.
     *
     * @param  array  $input
     * @return \GrahamCampbell\BootstrapCMS\Models\Page
     */
    public function update(array $input = array()) {
        $return = parent::update($input);
        LaravelEvent::fire('page.updated');
        return $return;
    }

    /**
     * Delete an existing page.
     *
     * @param  array  $input
     * @return void
     */
    public function delete() {
        $return = parent::delete();
        LaravelEvent::fire('page.deleted');
        return $return;
    }
}
