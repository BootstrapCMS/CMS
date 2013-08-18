<?php namespace GrahamCampbell\BootstrapCMS\Providers;

// use Config;

class PageProvider extends BaseProvider implements Interfaces\ISlugProvider {

    use Common\TraitSlugProvider;

    protected $model = 'GrahamCampbell\BootstrapCMS\Models\Page';

    // public function all() {
    //     if ('cache')
    //     $model = $this->model;
    //     return $model::get(array('id', 'user_id', 'created_at', 'updated_at', 'slug', 'title', 'icon'))->toArray();
    // }

}
