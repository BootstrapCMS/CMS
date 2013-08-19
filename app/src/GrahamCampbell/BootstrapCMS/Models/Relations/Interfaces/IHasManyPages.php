<?php namespace GrahamCampbell\BootstrapCMS\Models\Relations\Interfaces;

interface IHasManyPages {

    public function pages();

    public function getPages();

    public function findPage($slug, $columns = array('*'));

    public function deletePages();

}
