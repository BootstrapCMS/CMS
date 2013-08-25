<?php namespace GrahamCampbell\BootstrapCMS\Models\Relations\Common;

trait TraitHasManyPages {

    /**
     * Get the page relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOneOrMany
     */
    public function pages() {
        return $this->hasMany('GrahamCampbell\BootstrapCMS\Models\Page');
    }

    /**
     * Get the page collection.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getPages() {
        $model = 'GrahamCampbell\BootstrapCMS\Models\Comment';

        if (property_exists($model, 'order')) {
            return $this->pages()->orderBy($model::$order, $model::$sort)->get($model::$index);
        }

        return $this->pages()->get($model::$index);
    }

    /**
     * Get the specified page.
     *
     * @return \GrahamCampbell\BootstrapCMS\Models\Page
     */
    public function findPage($slug, $columns = array('*')) {
        return $this->pages()->where('slug', '=', $slug)->first($columns);
    }

    /**
     * Delete all pages.
     *
     * @return void
     */
    public function deletePages() {
        foreach($this->getPages(array('id')) as $page) {
            $page->delete();
        }
    }
}
