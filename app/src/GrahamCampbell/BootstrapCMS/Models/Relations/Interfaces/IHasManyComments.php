<?php namespace GrahamCampbell\BootstrapCMS\Models\Relations\Interfaces;

interface IHasManyComments {

    public function comments();

    public function getComments();

    public function findComment($id, $columns = array('*'));

    public function deleteComments();

}
