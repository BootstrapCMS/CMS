<?php namespace GrahamCampbell\BootstrapCMS\Models\Relations\Interfaces;

interface IHasManyPages {

    /**
     * Get the page relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOneOrMany
     */
    public function pages();

    /**
     * Get the page collection.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getPages();

    /**
     * Get the specified page.
     *
     * @return \GrahamCampbell\BootstrapCMS\Models\Page
     */
    public function findPage($slug, $columns = array('*'));

    /**
     * Delete all pages.
     *
     * @return void
     */
    public function deletePages();

}
