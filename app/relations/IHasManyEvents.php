<?php

interface IHasManyEvents {

    public function events();

    public function getEvents($columns = array('*'));

    public function findEvent($id, $columns = array('*'));

}
