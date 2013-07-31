<?php

class EloquentBaseRepository implements BaseRepositoryInterface {

    protected $model;

    public function all($columns = array('*')) {
        return $this->model->all($columns);
    }

    public function find($id, $columns = array('*')) {
        return $this->model->find($id, $columns);
    }

    public function create($attributes) {
        return $this->model->create($attributes);
    }

    public function fill($attributes) {
        return $this->model->fill($attributes);
    }

    public function save() {
        return $this->model->save();
    }

    public function update($attributes) {
        return $this->model->update($attributes);
    }
}
