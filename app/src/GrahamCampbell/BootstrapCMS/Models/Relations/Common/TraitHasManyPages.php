<?php namespace GrahamCampbell\BootstrapCMS\Models\Relations\Common;

trait TraitHasManyPages {

    public function pages() {
        return $this->hasMany('GrahamCampbell\BootstrapCMS\Models\Page');
    }

    public function getPages() {
        $model = 'GrahamCampbell\BootstrapCMS\Models\Comment';

        if (property_exists($model, 'order')) {
            return $this->pages()->orderBy($model::$order, $model::$sort)->get($model::$index);
        }

        return $this->pages()->get($model::$index);
    }

    public function findPage($slug, $columns = array('*')) {
        return $this->pages()->where('slug', '=', $slug)->first($columns);
    }

    public function deletePages() {
        foreach($this->getPages(array('id')) as $page) {
            $page->delete();
        }
    }
}
