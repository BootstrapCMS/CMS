<?php namespace GrahamCampbell\BootstrapCMS\Models;

use Cache;
use Config;

class Page extends BaseModel implements Interfaces\ITitleModel, Interfaces\ISlugModel, Interfaces\IBodyModel, Relations\Interfaces\IBelongsToUser {

    use Common\TraitTitleModel, Common\TraitSlugModel, Common\TraitBodyModel, Relations\Common\TraitBelongsToUser;

    protected $table = 'pages';

    public $rules = array(
        'title'      => 'required',
        'slug'       => 'required',
        'body'       => 'required',
        'show_title' => 'required',
        'show_nav'   => 'required',
        'user_id'    => 'required',
    );

    public $factory = array(
        'id'         => 1,
        'title'      => 'Page Title',
        'slug'       => 'page-title',
        'body'       => 'This is the page body!',
        'show_title' => true,
        'show_nav'   => true,
        'icon'       => '',
        'user_id'    => 1,
    );

    public function getShowTitle() {
        return $this->show_title;
    }

    public function getShowNav() {
        return $this->show_nav;
    }

    public function getIcon() {
        return $this->icon;
    }
}
