<?php

interface BaseRepositoryInterface {

    public function all($columns = array('*'));
    public function find($id, $columns = array('*'));
    public function create($attributes);
    public function fill($attributes);
    public function save();
    public function update($attributes);
}
